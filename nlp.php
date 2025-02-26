<div class="container-fluid pt-4 px-4">
    <div class="container mt-4">
        <h2>Advanced Medical Knowledge Assistant</h2>
        <div class="col-12">
            <div class="bg-light rounded py-5 border border-info h-100 p-4">

                <div class="row">
                    <div class="col-md-8">
                        <textarea id="queryInput" class="form-control" rows="4" placeholder="Ask any medical question (e.g., 'What is cancer?' or 'What are the latest treatments for diabetes?')"></textarea>
                    </div>
                    <div class="col-md-4">
                        <button id="submitQuery" class="btn btn-info text-white w-100">Search</button>
                        <div class="mt-2">
                            <select id="resultCount" class="form-control">
                                <option value="5">5 results</option>
                                <option value="10">10 results</option>
                                <option value="15">15 results</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Response</h6>
                            <div class="spinner-border text-info d-none" id="loadingSpinner" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div id="responseDisplay" class="border p-3 rounded shadow-sm" style="min-height: 200px;">
                            <p class="text-muted">Your comprehensive answer will appear here.</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="accordion" id="sourcesAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sourcesList">
                                        View Research Sources
                                    </button>
                                </h2>
                                <div id="sourcesList" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div id="articlesList"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
 document.getElementById('submitQuery').addEventListener('click', async function() {
            const query = document.getElementById('queryInput').value.trim();
            const resultCount = document.getElementById('resultCount').value;

            if (!query) {
                alert('Please enter a query');
                return;
            }

            // Basic client-side validation
            if (query.length < 5) {
                alert('Query is too short. Please be more specific.');
                return;
            }

            try {
                const response = await fetch('php/save_query.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        query: query,
                        resultCount: resultCount
                    })
                });

                const data = await response.json();

                if (data.status === 'success') {
                    console.log('Query saved successfully');
                    document.getElementById('queryInput').value = '';
                    // alert('Your query has been submitted successfully!');
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while processing your query');
            }
        });


        class MedicalKnowledgeBase {
            constructor(data) {
                this.definitions = data;
                this.cache = new Map();
            }

            getDefinition(condition) {
                return this.definitions[condition.toLowerCase()] || null;
            }

            isDefinitionQuery(query) {
                const definitionPatterns = [
                    /what is/i,
                    /what are/i,
                    /define/i,
                    /explain/i,
                    /tell me about/i
                ];
                return definitionPatterns.some(pattern => pattern.test(query));
            }

            findRelevantCondition(query) {
                return Object.keys(this.definitions).find(condition =>
                    query.toLowerCase().includes(condition.toLowerCase())
                );
            }
        }
        class MedicalQueryProcessor {
            constructor(data) {
                this.knowledgeBase = new MedicalKnowledgeBase(data);
                this.cache = new Map();
            }

            async processQuery(query, maxResults) {
                const cacheKey = `${query}-${maxResults}`;
                if (this.cache.has(cacheKey)) {
                    return this.cache.get(cacheKey);
                }

                let response = "";
                const isDefinitionQuery = this.knowledgeBase.isDefinitionQuery(query);
                const condition = this.knowledgeBase.findRelevantCondition(query);

                if (isDefinitionQuery && condition) {
                    response = this.generateDefinitionResponse(condition);
                }

                // Get research findings
                const articles = await this.fetchArticles(query, maxResults);
                const researchResponse = this.synthesizeResponse(query, articles);

                // Combine both responses if we have a definition
                const combinedResponse = response ?
                    `${response}\n\nRecent Research Findings:\n${researchResponse}` :
                    researchResponse;

                const result = {
                    response: combinedResponse,
                    articles: articles
                };

                this.cache.set(cacheKey, result);
                return result;
            }

            generateDefinitionResponse(condition) {
                const def = this.knowledgeBase.getDefinition(condition);
                if (!def) return "";

                let response = `${def.basic}\n\n`;

                if (def.types && def.types.length > 0) {
                    response += `Types of ${condition}:\n`;
                    def.types.forEach(type => response += `• ${type}\n`);
                    response += '\n';
                }

                if (def.generalSymptoms && def.generalSymptoms.length > 0) {
                    response += `Common symptoms include:\n`;
                    def.generalSymptoms.forEach(symptom => response += `• ${symptom}\n`);
                    response += '\n';
                }

                if (def.riskFactors && def.riskFactors.length > 0) {
                    response += `Risk factors include:\n`;
                    def.riskFactors.forEach(factor => response += `• ${factor}\n`);
                    response += '\n';
                }

                return response;
            }

            async fetchArticles(query, maxResults) {
                const esearchUrl = `https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&term=${encodeURIComponent(query)}&retmode=json&retmax=${maxResults}&sort=relevance`;

                const esearchResponse = await fetch(esearchUrl);
                const esearchData = await esearchResponse.json();
                const pmids = esearchData.esearchresult.idlist;

                if (pmids.length === 0) {
                    throw new Error("No articles found");
                }

                const efetchUrl = `https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=${pmids.join(",")}&retmode=xml&rettype=abstract`;
                const efetchResponse = await fetch(efetchUrl);
                const efetchData = await efetchResponse.text();

                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(efetchData, "text/xml");

                return Array.from(xmlDoc.getElementsByTagName("PubmedArticle")).map(article => {
                    const articleNode = article.getElementsByTagName("Article")[0];
                    return {
                        title: articleNode.getElementsByTagName("ArticleTitle")[0]?.textContent || "",
                        abstract: articleNode.getElementsByTagName("AbstractText")[0]?.textContent || "No abstract available.",
                        journal: articleNode.getElementsByTagName("Journal")[0]?.getElementsByTagName("Title")[0]?.textContent || "",
                        year: article.getElementsByTagName("PubDate")[0]?.getElementsByTagName("Year")[0]?.textContent || "",
                        authors: Array.from(articleNode.getElementsByTagName("Author")).map(author => {
                            const lastName = author.getElementsByTagName("LastName")[0]?.textContent || "";
                            const foreName = author.getElementsByTagName("ForeName")[0]?.textContent || "";
                            return `${lastName} ${foreName}`.trim();
                        }).join(", ")
                    };
                });
            }

            synthesizeResponse(query, articles) {
                const keyFindings = articles.map(article => {
                    return {
                        finding: this.extractKeyFindings(article.abstract),
                        year: article.year
                    };
                });

                const commonFindings = this.aggregateFindings(keyFindings);
                return this.generateResearchResponse(query, commonFindings, articles.length);
            }

            extractKeyFindings(text) {
                const sentences = text.split(/[.!?]+/).map(s => s.trim()).filter(s => s.length > 0);
                const medicalTerms = ['treatment', 'therapy', 'study', 'trial', 'results', 'findings', 'evidence', 'patients', 'research', 'discovery'];

                return sentences.filter(sentence =>
                    medicalTerms.some(term => sentence.toLowerCase().includes(term))
                );
            }

            aggregateFindings(findings) {
                const grouped = {};
                findings.forEach(({
                    finding,
                    year
                }) => {
                    finding.forEach(f => {
                        if (!grouped[f]) {
                            grouped[f] = {
                                count: 1,
                                years: [year]
                            };
                        } else {
                            grouped[f].count++;
                            if (!grouped[f].years.includes(year)) {
                                grouped[f].years.push(year);
                            }
                        }
                    });
                });

                return Object.entries(grouped)
                    .sort((a, b) => b[1].count - a[1].count)
                    .slice(0, 3);
            }

            generateResearchResponse(query, commonFindings, totalArticles) {
                if (commonFindings.length === 0) {
                    return "No specific research findings were found for this query.";
                }

                let response = `Based on ${totalArticles} recent medical studies:\n\n`;

                commonFindings.forEach(([finding, meta], index) => {
                    response += `${index + 1}. ${finding} (Found in ${meta.count} ${meta.count === 1 ? 'study' : 'studies'}, ${Math.min(...meta.years)}-${Math.max(...meta.years)})\n\n`;
                });

                return response;
            }
        }
        async function fetchMedicalData() {
            const response = await fetch('db/medicalbaseknowledge.json');
            if (!response.ok) {
                throw new Error('Failed to fetch medical knowledge base');
            }
            return await response.json();
        }
        // Initialize the UI handlers
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                const data = await fetchMedicalData();
                const processor = new MedicalQueryProcessor(data);
                const queryInput = document.getElementById('queryInput');
                const submitButton = document.getElementById('submitQuery');
                const responseDisplay = document.getElementById('responseDisplay');
                const articlesList = document.getElementById('articlesList');
                const loadingSpinner = document.getElementById('loadingSpinner');
                const resultCount = document.getElementById('resultCount');

                async function handleQuery() {
                    const query = queryInput.value.trim();
                    if (!query) {
                        responseDisplay.innerHTML = '<p class="text-danger">Please enter a question.</p>';
                        return;
                    }

                    loadingSpinner.classList.remove('d-none');
                    responseDisplay.innerHTML = '<p class="text-muted">Processing your question...</p>';
                    articlesList.innerHTML = '';

                    try {
                        const {
                            response,
                            articles
                        } = await processor.processQuery(query, parseInt(resultCount.value));

                        responseDisplay.innerHTML = `<div class="response-text">${response.split('\n').map(line =>
                        line.trim() ? `<p>${line.startsWith('•') ? line : line.replace(/^([0-9]+\.)/, '<strong>$1</strong>')}</p>` : ''
                    ).join('')}</div>`;

                        articlesList.innerHTML = articles.map((article, index) => `
                        <div class="article-card mb-3 p-3 border rounded">
                            <h6 class="article-title">${index + 1}. ${article.title}</h6>
                            <p class="article-meta text-muted">
                                <small>${article.authors} (${article.year}) - ${article.journal}</small>
                            </p>
                            <p class="article-abstract">${article.abstract}</p>
                        </div>
                    `).join('');

                    } catch (error) {
                        console.error("Error processing query:", error);
                        responseDisplay.innerHTML = `<p class="text-danger">Error: ${error.message}</p>`;
                    } finally {
                        loadingSpinner.classList.add('d-none');
                    }
                }

                submitButton.addEventListener('click', handleQuery);
                queryInput.addEventListener('keypress', function(event) {
                    if (event.key === 'Enter') {
                        handleQuery();
                    }
                });
            } catch (error) {
                console.error("Error fetching medical data:", error);
                document.getElementById('responseDisplay').innerHTML = `<p class="text-danger">Error fetching medical data: ${error.message}</p>`;
            }
        });
        
    </script>


    <style>
        .response-text {
            line-height: 1.6;
            font-size: 1.1em;
        }

        .response-text p {
            margin-bottom: 0.8em;
        }

        .article-card {
            background-color: #f8f9fa;
            transition: background-color 0.2s;
        }

        .article-card:hover {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .article-title {
            color: #2c3e50;
        }

        .article-meta {
            font-size: 0.9em;
        }

        .article-abstract {
            font-size: 0.95em;
            color: #4a5568;
        }
    </style>