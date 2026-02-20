# Agent skills reference

Quick reference for **agent skills**: what each skill is and **when to use it**. Use this when you want to route a task to the right skill or check what’s available.

This document is organized **by domain**. All skills listed below are loaded from this workspace (`.cursor/skills/`), including the antigravity-awesome-skills collection—**800+ skills** in total. Each row is one skill; “—” means the skill’s `SKILL.md` uses a multiline or alternate description format (open the file for the full “when to use” text).

---

## WordPress

| Skill | When to use |
|-------|-------------|
| **WordPress Penetration Testing** | — |
| **wordpress-router** | Use when the user asks about WordPress codebases (plugins, themes, block themes, Gutenberg blocks, WP core checkouts) and you need to quickly classify the repo and route to the correct workflow/skill (blocks, theme.json, REST API, WP-CLI, performance, security, testing, release packaging). |
| **wp-abilities-api** | Use when working with the WordPress Abilities API (wp_register_ability, wp_register_ability_category, /wp-json/wp-abilities/v1/*, @wordpress/abilities) including defining abilities, categories, meta, REST exposure, and permissions checks for clients. |
| **wp-block-development** | Use when developing WordPress (Gutenberg) blocks: block.json metadata, register_block_type(_from_metadata), attributes/serialization, supports, dynamic rendering (render.php/render_callback), deprecations/migrations, viewScript vs viewScriptModule, and @wordpress/scripts/@wordpress/create-block build and test workflows. |
| **wp-block-themes** | Use when developing WordPress block themes: theme.json (global settings/styles), templates and template parts, patterns, style variations, and Site Editor troubleshooting (style hierarchy, overrides, caching). |
| **wp-interactivity-api** | Use when building or debugging WordPress Interactivity API features (data-wp-* directives, @wordpress/interactivity store/state/actions, block viewScriptModule integration, wp_interactivity_*()) including performance, hydration, and directive behavior. |
| **wp-performance** | Use when investigating or improving WordPress performance (backend-only agent): profiling and measurement (WP-CLI profile/doctor, Server-Timing, Query Monitor via REST headers), database/query optimization, autoloaded options, object caching, cron, HTTP API calls, and safe verification. |
| **wp-phpstan** | Use when configuring, running, or fixing PHPStan static analysis in WordPress projects (plugins/themes/sites): phpstan.neon setup, baselines, WordPress-specific typing, and handling third-party plugin classes. |
| **wp-playground** | Use for WordPress Playground workflows: fast disposable WP instances in the browser or locally via @wp-playground/cli (server, run-blueprint, build-snapshot), auto-mounting plugins/themes, switching WP/PHP versions, blueprints, and debugging (Xdebug). |
| **wp-plugin-development** | Use when developing WordPress plugins: architecture and hooks, activation/deactivation/uninstall, admin UI and Settings API, data storage, cron/tasks, security (nonces/capabilities/sanitization/escaping), and release packaging. |
| **wp-project-triage** | Use when you need a deterministic inspection of a WordPress repository (plugin/theme/block theme/WP core/Gutenberg/full site) including tooling/tests/version hints, and a structured JSON report to guide workflows and guardrails. |
| **wp-rest-api** | Use when building, extending, or debugging WordPress REST API endpoints/routes: register_rest_route, WP_REST_Controller/controller classes, schema/argument validation, permission_callback/authentication, response shaping, register_rest_field/register_meta, or exposing CPTs/taxonomies via show_in_rest. |
| **wp-wpcli-and-ops** | Use when working with WP-CLI (wp) for WordPress operations: safe search-replace, db export/import, plugin/theme/user/content management, cron, cache flushing, multisite, and scripting/automation with wp-cli.yml. |
| **wpds** | Use when building UIs leveraging the WordPress Design System (WPDS) and its components, tokens, patterns, etc. |

## Frontend
| Skill | When to use |
|-------|-------------|
| **accessibility-compliance-accessibility-audit** | You are an accessibility expert specializing in WCAG compliance, inclusive design, and assistive technology compatibility. Conduct audits, identify barriers, and provide remediation guidance. |
| **angular** | — |
| **angular-best-practices** | — |
| **angular-migration** | — |
| **angular-state-management** | — |
| **angular-ui-patterns** | — |
| **flutter-expert** | — |
| **fp-ts-react** | — |
| **frontend-design** | — |
| **frontend-dev-guidelines** | — |
| **frontend-developer** | — |
| **frontend-mobile-development-component-scaffold** | You are a React component architecture expert specializing in scaffolding production-ready, accessible, and performant components. Generate complete component implementations with TypeScript, tests, s |
| **frontend-mobile-security-xss-scan** | You are a frontend security specialist focusing on Cross-Site Scripting (XSS) vulnerability detection and prevention. Analyze React, Vue, Angular, and vanilla JavaScript code to identify injection poi |
| **frontend-patterns** | — |
| **frontend-security-coder** | — |
| **frontend-slides** | — |
| **frontend-ui-dark-ts** | — |
| **nextjs-app-router-patterns** | — |
| **nextjs-best-practices** | — |
| **nextjs-supabase-auth** | Expert integration of Supabase Auth with Next.js App Router Use when: supabase auth next, authentication next.js, login supabase, auth middleware, protected route. |
| **radix-ui-design-system** | — |
| **react-flow-architect** | Expert ReactFlow architect for building interactive graph applications with hierarchical node-edge systems, performance optimization, and auto-layout integration. Use when Claude needs to create or optimize ReactFlow applications for: (1) Interactive process graphs with expand/collapse navigation, (2) Hierarchical tree structures with drag & drop,  |
| **react-flow-node-ts** | — |
| **react-modernization** | — |
| **react-native-architecture** | — |
| **react-patterns** | — |
| **react-state-management** | — |
| **react-ui-patterns** | — |
| **stitch-ui-design** | — |
| **swiftui-expert-skill** | Write, review, or improve SwiftUI code following best practices for state management, view composition, performance, modern APIs, Swift concurrency, and iOS 26+ Liquid Glass adoption. Use when building new SwiftUI features, refactoring existing views, reviewing code quality, or adopting modern SwiftUI patterns. |
| **tailwind-design-system** | — |
| **tailwind-patterns** | — |
| **threejs-skills** | — |
| **ui-skills** | Opinionated, evolving constraints to guide agents when building interfaces |
| **ui-ux-designer** | — |
| **ui-ux-pro-max** | UI/UX design intelligence. 50 styles, 21 palettes, 50 font pairings, 20 charts, 9 stacks (React, Next.js, Vue, Svelte, SwiftUI, React Native, Flutter, Tailwind, shadcn/ui). Actions: plan, build, create, design, implement, review, fix, improve, optimize, enhance, refactor, check UI/UX code. Projects: website, landing page, dashboard, admin panel, e- |
| **ui-visual-validator** | — |
| **vercel-react-best-practices** | — |
| **wcag-audit-patterns** | — |

## Backend
| Skill | When to use |
|-------|-------------|
| **API Fuzzing for Bug Bounty** | — |
| **api-design-principles** | — |
| **api-documentation-generator** | Generate comprehensive, developer-friendly API documentation from code, including endpoints, parameters, examples, and best practices |
| **api-documenter** | — |
| **api-patterns** | — |
| **api-security-best-practices** | Implement secure API design patterns including authentication, authorization, input validation, rate limiting, and protection against common API vulnerabilities |
| **api-testing-observability-api-mock** | You are an API mocking expert specializing in realistic mock services for development, testing, and demos. Design mocks that simulate real API behavior and enable parallel development. |
| **azure-ai-agents-persistent-dotnet** | — |
| **azure-ai-document-intelligence-dotnet** | — |
| **azure-ai-openai-dotnet** | — |
| **azure-ai-projects-dotnet** | — |
| **azure-ai-voicelive-dotnet** | — |
| **azure-eventgrid-dotnet** | — |
| **azure-eventhub-dotnet** | — |
| **azure-identity-dotnet** | — |
| **azure-maps-search-dotnet** | — |
| **azure-mgmt-apicenter-dotnet** | — |
| **azure-mgmt-apimanagement-dotnet** | — |
| **azure-mgmt-applicationinsights-dotnet** | — |
| **azure-mgmt-arizeaiobservabilityeval-dotnet** | — |
| **azure-mgmt-botservice-dotnet** | — |
| **azure-mgmt-fabric-dotnet** | — |
| **azure-mgmt-mongodbatlas-dotnet** | — |
| **azure-mgmt-weightsandbiases-dotnet** | — |
| **azure-resource-manager-cosmosdb-dotnet** | — |
| **azure-resource-manager-durabletask-dotnet** | — |
| **azure-resource-manager-mysql-dotnet** | — |
| **azure-resource-manager-playwright-dotnet** | — |
| **azure-resource-manager-postgresql-dotnet** | — |
| **azure-resource-manager-redis-dotnet** | — |
| **azure-resource-manager-sql-dotnet** | — |
| **azure-search-documents-dotnet** | — |
| **azure-security-keyvault-keys-dotnet** | — |
| **azure-servicebus-dotnet** | — |
| **backend-architect** | — |
| **backend-dev-guidelines** | — |
| **backend-development-feature-development** | Orchestrate end-to-end backend feature development from requirements to deployment. Use when coordinating multi-phase feature delivery across teams and services. |
| **backend-patterns** | — |
| **backend-security-coder** | — |
| **dbos-golang** | — |
| **django-pro** | — |
| **dotnet-architect** | — |
| **dotnet-backend** | — |
| **dotnet-backend-patterns** | — |
| **fastapi-pro** | — |
| **fastapi-router-py** | — |
| **fastapi-templates** | — |
| **gemini-api-dev** | — |
| **go-concurrency-patterns** | — |
| **go-playwright** | — |
| **go-rod-master** | Comprehensive guide for browser automation and web scraping with go-rod (Chrome DevTools Protocol) including stealth anti-bot-detection patterns. |
| **golang-pro** | — |
| **laravel-expert** | — |
| **laravel-security-audit** | — |
| **m365-agents-dotnet** | — |
| **microsoft-azure-webjobs-extensions-authentication-events-dotnet** | — |
| **moodle-external-api-development** | — |
| **n8n-node-configuration** | Operation-aware node configuration guidance. Use when configuring nodes, understanding property dependencies, determining required fields, choosing between get_node detail levels, or learning common configuration patterns by node type. |
| **nestjs-expert** | — |
| **nodejs-backend-patterns** | — |
| **nodejs-best-practices** | — |
| **openapi-spec-generation** | — |
| **php-pro** | — |

## Data
| Skill | When to use |
|-------|-------------|
| **azure-ai-ml-py** | — |
| **azure-data-tables-java** | — |
| **azure-data-tables-py** | — |
| **azure-postgres-ts** | — |
| **Cross-Site Scripting and HTML Injection Testing** | — |
| **data-engineer** | — |
| **data-engineering-data-driven-feature** | Build features guided by data insights, A/B testing, and continuous measurement using specialized agents for analysis, implementation, and experimentation. |
| **data-engineering-data-pipeline** | You are a data pipeline architecture expert specializing in scalable, reliable, and cost-effective data pipelines for batch and streaming data processing. |
| **data-quality-frameworks** | — |
| **data-scientist** | — |
| **data-storytelling** | — |
| **database-migrations-sql-migrations** | — |
| **dbt-transformation-patterns** | — |
| **embedding-strategies** | — |
| **gdpr-data-handling** | — |
| **HTML Injection Testing** | — |
| **machine-learning-ops-ml-pipeline** | Design and implement a complete ML pipeline for: $ARGUMENTS |
| **ml-engineer** | — |
| **ml-pipeline-workflow** | — |
| **neon-postgres** | Expert patterns for Neon serverless Postgres, branching, connection pooling, and Prisma/Drizzle integration Use when: neon database, serverless postgres, database branching, neon postgres, postgres serverless. |
| **nosql-expert** | Expert guidance for distributed NoSQL databases (Cassandra, DynamoDB). Focuses on mental models, query-first modeling, single-table design, and avoiding hot partitions in high-scale systems. |
| **postgresql** | — |
| **prisma-expert** | — |
| **rag-engineer** | Expert in building Retrieval-Augmented Generation systems. Masters embedding models, vector databases, chunking strategies, and retrieval optimization for LLM applications. Use when: building RAG, vector search, embeddings, semantic search, document retrieval. |
| **rag-implementation** | — |
| **SQL Injection Testing** | — |
| **sql-optimization-patterns** | — |
| **sql-pro** | — |
| **SQLMap Database Penetration Testing** | — |
| **supabase-postgres-best-practices** | — |
| **vector-database-engineer** | Expert in vector databases, embedding strategies, and semantic search implementation. Masters Pinecone, Weaviate, Qdrant, Milvus, and pgvector for RAG applications, recommendation systems, and similar |

## Cloud
| Skill | When to use |
|-------|-------------|
| **agent-framework-azure-ai-py** | — |
| **AWS Penetration Testing** | — |
| **aws-serverless** | Specialized skill for building production-ready serverless applications on AWS. Covers Lambda functions, API Gateway, DynamoDB, SQS/SNS event-driven patterns, SAM/CDK deployment, and cold start optimization. |
| **aws-skills** | AWS development with infrastructure automation and cloud architecture patterns |
| **azure-ai-agents-persistent-java** | — |
| **azure-ai-anomalydetector-java** | — |
| **azure-ai-contentsafety-java** | — |
| **azure-ai-contentsafety-py** | — |
| **azure-ai-contentsafety-ts** | — |
| **azure-ai-contentunderstanding-py** | — |
| **azure-ai-document-intelligence-ts** | — |
| **azure-ai-formrecognizer-java** | — |
| **azure-ai-projects-java** | — |
| **azure-ai-projects-py** | — |
| **azure-ai-projects-ts** | — |
| **azure-ai-textanalytics-py** | — |
| **azure-ai-transcription-py** | — |
| **azure-ai-translation-document-py** | — |
| **azure-ai-translation-text-py** | — |
| **azure-ai-translation-ts** | — |
| **azure-ai-vision-imageanalysis-java** | — |
| **azure-ai-vision-imageanalysis-py** | — |
| **azure-ai-voicelive-java** | — |
| **azure-ai-voicelive-py** | — |
| **azure-ai-voicelive-ts** | — |
| **azure-appconfiguration-java** | — |
| **azure-appconfiguration-py** | — |
| **azure-appconfiguration-ts** | — |
| **azure-communication-callautomation-java** | — |
| **azure-communication-callingserver-java** | — |
| **azure-communication-chat-java** | — |
| **azure-communication-common-java** | — |
| **azure-communication-sms-java** | — |
| **azure-compute-batch-java** | — |
| **azure-containerregistry-py** | — |
| **azure-cosmos-db-py** | — |
| **azure-cosmos-java** | — |
| **azure-cosmos-py** | — |
| **azure-cosmos-rust** | — |
| **azure-cosmos-ts** | — |
| **azure-eventgrid-java** | — |
| **azure-eventgrid-py** | — |
| **azure-eventhub-java** | — |
| **azure-eventhub-py** | — |
| **azure-eventhub-rust** | — |
| **azure-eventhub-ts** | — |
| **azure-functions** | Expert patterns for Azure Functions development including isolated worker model, Durable Functions orchestration, cold start optimization, and production patterns. Covers .NET, Python, and Node.js programming models. Use when: azure function, azure functions, durable functions, azure serverless, function app. |
| **azure-identity-java** | — |
| **azure-identity-py** | — |
| **azure-identity-rust** | — |
| **azure-identity-ts** | — |
| **azure-keyvault-certificates-rust** | — |
| **azure-keyvault-keys-rust** | — |
| **azure-keyvault-keys-ts** | — |
| **azure-keyvault-py** | — |
| **azure-keyvault-secrets-rust** | — |
| **azure-keyvault-secrets-ts** | — |
| **azure-messaging-webpubsub-java** | — |
| **azure-messaging-webpubsubservice-py** | — |
| **azure-mgmt-apicenter-py** | — |
| **azure-mgmt-apimanagement-py** | — |
| **azure-mgmt-botservice-py** | — |
| **azure-mgmt-fabric-py** | — |
| **azure-microsoft-playwright-testing-ts** | — |
| **azure-monitor-ingestion-java** | — |
| **azure-monitor-ingestion-py** | — |
| **azure-monitor-opentelemetry-exporter-java** | — |
| **azure-monitor-opentelemetry-exporter-py** | — |
| **azure-monitor-opentelemetry-py** | — |
| **azure-monitor-opentelemetry-ts** | — |
| **azure-monitor-query-java** | — |
| **azure-monitor-query-py** | — |
| **azure-search-documents-py** | — |
| **azure-search-documents-ts** | — |
| **azure-security-keyvault-keys-java** | — |
| **azure-security-keyvault-secrets-java** | — |
| **azure-servicebus-py** | — |
| **azure-servicebus-ts** | — |
| **azure-speech-to-text-rest-py** | — |
| **azure-storage-blob-java** | — |
| **azure-storage-blob-py** | — |
| **azure-storage-blob-rust** | — |
| **azure-storage-blob-ts** | — |
| **azure-storage-file-datalake-py** | — |
| **azure-storage-file-share-py** | — |
| **azure-storage-file-share-ts** | — |
| **azure-storage-queue-py** | — |
| **azure-storage-queue-ts** | — |
| **azure-web-pubsub-ts** | — |
| **devops-troubleshooter** | — |
| **docker-expert** | — |
| **gcp-cloud-run** | Specialized skill for building production-ready serverless applications on GCP. Covers Cloud Run services (containerized), Cloud Run Functions (event-driven), cold start optimization, and event-driven architecture with Pub/Sub. |
| **github-actions-templates** | — |
| **k8s-manifest-generator** | — |
| **k8s-security-policies** | — |
| **kubernetes-architect** | — |
| **terraform-module-library** | — |
| **terraform-skill** | Terraform infrastructure as code best practices |
| **terraform-specialist** | — |

## Security
| Skill | When to use |
|-------|-------------|
| **auth-implementation-patterns** | — |
| **backtesting-frameworks** | — |
| **bats-testing-patterns** | — |
| **Broken Authentication Testing** | — |
| **Burp Suite Web Application Testing** | — |
| **clerk-auth** | Expert patterns for Clerk auth implementation, middleware, organizations, webhooks, and user sync Use when: adding authentication, clerk auth, user authentication, sign in, sign up. |
| **Cloud Penetration Testing** | — |
| **doc-coauthoring** | — |
| **e2e-testing-patterns** | — |
| **File Path Traversal Testing** | — |
| **IDOR Vulnerability Testing** | — |
| **javascript-testing-patterns** | — |
| **mobile-security-coder** | — |
| **pci-compliance** | — |
| **Pentest Checklist** | — |
| **Pentest Commands** | — |
| **performance-testing-review-ai-review** | You are an expert AI-powered code review specialist combining automated static analysis, intelligent pattern recognition, and modern DevOps practices. Leverage AI tools (GitHub Copilot, Qodo, GPT-5, C |
| **performance-testing-review-multi-agent-review** | Use when working with performance testing review multi agent review |
| **playwright-skill** | — |
| **python-testing-patterns** | — |
| **screen-reader-testing** | — |
| **Security Scanning Tools** | — |
| **security-auditor** | — |
| **security-bluebook-builder** | Build security Blue Books for sensitive apps |
| **security-compliance-compliance-check** | You are a compliance expert specializing in regulatory requirements for software systems including GDPR, HIPAA, SOC2, PCI-DSS, and other industry standards. Perform compliance audits and provide implementation guidance. |
| **security-requirement-extraction** | — |
| **security-review** | — |
| **security-scanning-security-dependencies** | You are a security expert specializing in dependency vulnerability analysis, SBOM generation, and supply chain security. Scan project dependencies across ecosystems to identify vulnerabilities, assess risks, and recommend remediation. |
| **security-scanning-security-hardening** | Coordinate multi-layer security scanning and hardening across application, infrastructure, and compliance controls. |
| **security-scanning-security-sast** | — |
| **seo-authority-builder** | — |
| **Shodan Reconnaissance and Pentesting** | — |
| **SMTP Penetration Testing** | — |
| **solidity-security** | — |
| **SSH Penetration Testing** | — |
| **temporal-python-testing** | — |
| **testing-patterns** | — |
| **unit-testing-test-generate** | — |
| **vulnerability-scanner** | — |
| **web3-testing** | — |
| **webapp-testing** | — |

## Content
| Skill | When to use |
|-------|-------------|
| **content-creator** | — |
| **content-marketer** | — |
| **copywriting** | — |
| **marketing-ideas** | — |
| **marketing-psychology** | — |
| **programmatic-seo** | — |
| **schema-markup** | — |
| **seo-audit** | — |
| **seo-cannibalization-detector** | — |
| **seo-content-auditor** | — |
| **seo-content-planner** | — |
| **seo-content-refresher** | — |
| **seo-content-writer** | — |
| **seo-fundamentals** | — |
| **seo-keyword-strategist** | — |
| **seo-meta-optimizer** | — |
| **seo-snippet-hunter** | — |
| **seo-structure-architect** | — |

## AI
| Skill | When to use |
|-------|-------------|
| **agent-evaluation** | Testing and benchmarking LLM agents including behavioral testing, capability assessment, reliability metrics, and production monitoring—where even top agents achieve less than 50% on real-world benchmarks Use when: agent testing, agent evaluation, benchmark agents, agent reliability, test agent. |
| **agent-manager-skill** | — |
| **agent-memory-mcp** | — |
| **agent-memory-systems** | Memory is the cornerstone of intelligent agents. Without it, every interaction starts from zero. This skill covers the architecture of agent memory: short-term (context window), long-term (vector stores), and the cognitive architectures that organize them. Key insight: Memory isn't just storage - it's retrieval. A million stored facts mean nothing  |
| **agent-orchestration-improve-agent** | Systematic improvement of existing agents through performance analysis, prompt engineering, and continuous iteration. |
| **agent-orchestration-multi-agent-optimize** | Optimize multi-agent systems with coordinated profiling, workload distribution, and cost-aware orchestration. Use when improving agent performance, throughput, or reliability. |
| **agent-tool-builder** | Tools are how AI agents interact with the world. A well-designed tool is the difference between an agent that works and one that hallucinates, fails silently, or costs 10x more tokens than necessary. This skill covers tool design from schema to error handling. JSON Schema best practices, description writing that actually helps the LLM, validation,  |
| **autonomous-agent-patterns** | Design patterns for building autonomous coding agents. Covers tool integration, permission systems, browser automation, and human-in-the-loop workflows. Use when building AI agents, designing tool APIs, implementing permission systems, or creating autonomous coding assistants. |
| **bullmq-specialist** | BullMQ expert for Redis-backed job queues, background processing, and reliable async execution in Node.js/TypeScript applications. Use when: bullmq, bull queue, redis queue, background job, job queue. |
| **error-debugging-multi-agent-review** | Use when working with error debugging multi agent review |
| **langchain-architecture** | — |
| **llm-app-patterns** | Production-ready patterns for building LLM applications. Covers RAG pipelines, agent architectures, prompt IDEs, and LLMOps monitoring. Use when designing AI applications, implementing RAG, building agents, or setting up LLM observability. |
| **llm-application-dev-ai-assistant** | You are an AI assistant development expert specializing in creating intelligent conversational interfaces, chatbots, and AI-powered applications. Design comprehensive AI assistant solutions with natur |
| **llm-application-dev-langchain-agent** | You are an expert LangChain agent developer specializing in production-grade AI systems using LangChain 0.1+ and LangGraph. |
| **llm-application-dev-prompt-optimize** | You are an expert prompt engineer specializing in crafting effective prompts for LLMs through advanced techniques including constitutional AI, chain-of-thought reasoning, and model-specific optimizati |
| **llm-evaluation** | — |
| **multi-agent-brainstorming** | — |
| **multi-agent-patterns** | Master orchestrator, peer-to-peer, and hierarchical multi-agent architectures |
| **prompt-caching** | Caching strategies for LLM prompts including Anthropic prompt caching, response caching, and CAG (Cache Augmented Generation) Use when: prompt caching, cache prompt, response cache, cag, cache augmented. |
| **prompt-engineer** | Transforms user prompts into optimized prompts using frameworks (RTF, RISEN, Chain of Thought, RODES, Chain of Density, RACE, RISE, STAR, SOAP, CLEAR, GROW) |
| **prompt-engineering** | — |
| **prompt-engineering-patterns** | — |
| **prompt-library** | Curated collection of high-quality prompts for various use cases. Includes role-based prompts, task-specific templates, and prompt refinement techniques. Use when user needs prompt templates, role-play prompts, or ready-to-use prompt examples for coding, writing, analysis, or creative tasks. |
| **subagent-driven-development** | — |

## Product
| Skill | When to use |
|-------|-------------|
| **changelog-automation** | — |
| **conductor-implement** | — |
| **conductor-manage** | Manage track lifecycle: archive, restore, delete, rename, and cleanup |
| **conductor-new-track** | — |
| **conductor-revert** | — |
| **conductor-setup** | — |
| **conductor-status** | — |
| **conductor-validator** | — |
| **product-manager-toolkit** | — |
| **track-management** | — |
| **wiki-changelog** | — |
| **writing-plans** | — |

## Misc
| Skill | When to use |
|-------|-------------|
| **2d-games** | — |
| **3d-games** | — |
| **3d-web-experience** | Expert in building 3D experiences for the web - Three.js, React Three Fiber, Spline, WebGL, and interactive 3D scenes. Covers product configurators, 3D portfolios, immersive websites, and bringing depth to web experiences. Use when: 3D website, three.js, WebGL, react three fiber, 3D experience. |
| **ab-test-setup** | — |
| **Active Directory Attacks** | — |
| **activecampaign-automation** | Automate ActiveCampaign tasks via Rube MCP (Composio): manage contacts, tags, list subscriptions, automation enrollment, and tasks. Always search tools first for current schemas. |
| **address-github-comments** | — |
| **agents-v2-py** | — |
| **ai-agents-architect** | Expert in designing and building autonomous AI agents. Masters tool use, memory systems, planning strategies, and multi-agent orchestration. Use when: build agent, AI agent, autonomous agent, tool use, function calling. |
| **ai-engineer** | — |
| **ai-product** | Every product will be AI-powered. The question is whether you'll build it right or ship a demo that falls apart in production. This skill covers LLM integration patterns, RAG architecture, prompt engineering that scales, AI UX that users trust, and cost optimization that doesn't bankrupt you. Use when: keywords, file_patterns, code_patterns. |
| **ai-wrapper-product** | Expert in building products that wrap AI APIs (OpenAI, Anthropic, etc.) into focused tools people will pay for. Not just 'ChatGPT but different' - products that solve specific problems with AI. Covers prompt engineering for products, cost management, rate limiting, and building defensible AI businesses. Use when: AI wrapper, GPT product, AI tool, w |
| **airflow-dag-patterns** | — |
| **airtable-automation** | Automate Airtable tasks via Rube MCP (Composio): records, bases, tables, fields, views. Always search tools first for current schemas. |
| **algolia-search** | Expert patterns for Algolia search implementation, indexing strategies, React InstantSearch, and relevance tuning Use when: adding search to, algolia, instantsearch, search api, search functionality. |
| **algorithmic-art** | — |
| **amplitude-automation** | Automate Amplitude tasks via Rube MCP (Composio): events, user activity, cohorts, user identification. Always search tools first for current schemas. |
| **analytics-tracking** | — |
| **anti-reversing-techniques** | — |
| **antigravity-workflows** | Orchestrate multiple Antigravity skills through guided workflows for SaaS MVP delivery, security audits, AI agent builds, and browser QA. |
| **app-builder** | — |
| **app-store-optimization** | — |
| **application-performance-performance-optimization** | Optimize end-to-end application performance with profiling, observability, and backend/frontend tuning. Use when coordinating performance optimization across the stack. |
| **architect-review** | — |
| **architecture** | — |
| **architecture-decision-records** | — |
| **architecture-patterns** | — |
| **arm-cortex-expert** | — |
| **asana-automation** | Automate Asana tasks via Rube MCP (Composio): tasks, projects, sections, teams, workspaces. Always search tools first for current schemas. |
| **async-python-patterns** | — |
| **attack-tree-construction** | — |
| **audio-transcriber** | Transform audio recordings into professional Markdown documentation with intelligent summaries using LLM integration |
| **automate-whatsapp** | Build WhatsApp automations with Kapso workflows: configure WhatsApp triggers, edit workflow graphs, manage executions, deploy functions, and use databases/integrations for state. Use when automating WhatsApp conversations and event handling. |
| **autonomous-agents** | Autonomous agents are AI systems that can independently decompose goals, plan actions, execute tools, and self-correct without constant human guidance. The challenge isn't making them capable - it's making them reliable. Every extra decision multiplies failure probability. This skill covers agent loops (ReAct, Plan-Execute), goal decomposition, ref |
| **avalonia-layout-zafiro** | — |
| **avalonia-viewmodels-zafiro** | — |
| **avalonia-zafiro-development** | — |
| **azd-deployment** | — |
| **bamboohr-automation** | Automate BambooHR tasks via Rube MCP (Composio): employees, time-off, benefits, dependents, employee updates. Always search tools first for current schemas. |
| **basecamp-automation** | Automate Basecamp project management, to-dos, messages, people, and to-do list organization via Rube MCP (Composio). Always search tools first for current schemas. |
| **bash-defensive-patterns** | — |
| **bash-linux** | — |
| **bash-pro** | — |
| **bazel-build-optimization** | — |
| **beautiful-prose** | Hard-edged writing style contract for timeless, forceful English prose without AI tics |
| **behavioral-modes** | — |
| **billing-automation** | — |
| **binary-analysis-patterns** | — |
| **bitbucket-automation** | Automate Bitbucket repositories, pull requests, branches, issues, and workspace management via Rube MCP (Composio). Always search tools first for current schemas. |
| **blockchain-developer** | — |
| **blockrun** | — |
| **box-automation** | Automate Box cloud storage operations including file upload/download, search, folder management, sharing, collaborations, and metadata queries via Rube MCP (Composio). Always search tools first for current schemas. |
| **brainstorming** | — |
| **brand-guidelines** | — |
| **brevo-automation** | Automate Brevo (Sendinblue) tasks via Rube MCP (Composio): manage email campaigns, create/edit templates, track senders, and monitor campaign performance. Always search tools first for current schemas. |
| **browser-automation** | Browser automation powers web testing, scraping, and AI agent interactions. The difference between a flaky script and a reliable system comes down to understanding selectors, waiting strategies, and anti-detection patterns. This skill covers Playwright (recommended) and Puppeteer, with patterns for testing, scraping, and agentic browser control. Ke |
| **browser-extension-builder** | Expert in building browser extensions that solve real problems - Chrome, Firefox, and cross-browser extensions. Covers extension architecture, manifest v3, content scripts, popup UIs, monetization strategies, and Chrome Web Store publishing. Use when: browser extension, chrome extension, firefox addon, extension, manifest v3. |
| **bun-development** | Modern JavaScript/TypeScript development with Bun runtime. Covers package management, bundling, testing, and migration from Node.js. Use when working with Bun, optimizing JS/TS development speed, or migrating from Node.js to Bun. |
| **business-analyst** | — |
| **busybox-on-windows** | — |
| **c-pro** | — |
| **c4-architecture-c4-architecture** | Generate comprehensive C4 architecture documentation for an existing repository/codebase using a bottom-up analysis approach. |
| **c4-code** | — |
| **c4-component** | — |
| **c4-container** | — |
| **c4-context** | — |
| **cal-com-automation** | Automate Cal.com tasks via Rube MCP (Composio): manage bookings, check availability, configure webhooks, and handle teams. Always search tools first for current schemas. |
| **calendly-automation** | Automate Calendly scheduling, event management, invitee tracking, availability checks, and organization administration via Rube MCP (Composio). Always search tools first for current schemas. |
| **canva-automation** | Automate Canva tasks via Rube MCP (Composio): designs, exports, folders, brand templates, autofill. Always search tools first for current schemas. |
| **canvas-design** | — |
| **cc-skill-continuous-learning** | — |
| **cc-skill-project-guidelines-example** | — |
| **cc-skill-strategic-compact** | — |
| **cicd-automation-workflow-automate** | You are a workflow automation expert specializing in creating efficient CI/CD pipelines, GitHub Actions workflows, and automated development processes. Design automation that reduces manual work, improves consistency, and accelerates delivery while maintaining quality and security. |
| **circleci-automation** | Automate CircleCI tasks via Rube MCP (Composio): trigger pipelines, monitor workflows/jobs, retrieve artifacts and test metadata. Always search tools first for current schemas. |
| **clarity-gate** | Pre-ingestion verification for epistemic quality in RAG systems with 9-point verification and Two-Round HITL workflow |
| **Claude Code Guide** | — |
| **claude-ally-health** | A health assistant skill for medical information analysis, symptom tracking, and wellness guidance. |
| **claude-scientific-skills** | Scientific research and analysis skills |
| **claude-speed-reader** | -Speed read Claude's responses at 600+ WPM using RSVP with Spritz-style ORP highlighting |
| **claude-win11-speckit-update-skill** | Windows 11 system management |
| **clean-code** | Applies principles from Robert C. Martin's 'Clean Code'. Use this skill when writing, reviewing, or refactoring code to ensure high quality, readability, and maintainability. Covers naming, functions, comments, error handling, and class design. |
| **clickhouse-io** | — |
| **clickup-automation** | Automate ClickUp project management including tasks, spaces, folders, lists, comments, and team operations via Rube MCP (Composio). Always search tools first for current schemas. |
| **close-automation** | Automate Close CRM tasks via Rube MCP (Composio): create leads, manage calls/SMS, handle tasks, and track notes. Always search tools first for current schemas. |
| **cloud-architect** | — |
| **coda-automation** | Automate Coda tasks via Rube MCP (Composio): manage docs, pages, tables, rows, formulas, permissions, and publishing. Always search tools first for current schemas. |
| **code-documentation-code-explain** | You are a code education expert specializing in explaining complex code through clear narratives, visual diagrams, and step-by-step breakdowns. Transform difficult concepts into understandable explanations. |
| **code-documentation-doc-generate** | You are a documentation expert specializing in creating comprehensive, maintainable documentation from code. Generate API docs, architecture diagrams, user guides, and technical references using AI-powered analysis and industry best practices. |
| **code-refactoring-context-restore** | Use when working with code refactoring context restore |
| **code-refactoring-refactor-clean** | You are a code refactoring expert specializing in clean code principles, SOLID design patterns, and modern software engineering best practices. Analyze and refactor the provided code to improve its quality, maintainability, and performance. |
| **code-refactoring-tech-debt** | You are a technical debt expert specializing in identifying, quantifying, and prioritizing technical debt in software projects. Analyze the codebase to uncover debt, assess its impact, and create acti |
| **code-review-ai-ai-review** | You are an expert AI-powered code review specialist combining automated static analysis, intelligent pattern recognition, and modern DevOps practices. Leverage AI tools (GitHub Copilot, Qodo, GPT-5, C |
| **code-review-checklist** | Comprehensive checklist for conducting thorough code reviews covering functionality, security, performance, and maintainability |
| **code-review-excellence** | — |
| **code-reviewer** | — |
| **codebase-cleanup-deps-audit** | You are a dependency security expert specializing in vulnerability scanning, license compliance, and supply chain security. Analyze project dependencies for known vulnerabilities, licensing issues, outdated packages, and provide actionable remediation strategies. |
| **codebase-cleanup-refactor-clean** | You are a code refactoring expert specializing in clean code principles, SOLID design patterns, and modern software engineering best practices. Analyze and refactor the provided code to improve its quality, maintainability, and performance. |
| **codebase-cleanup-tech-debt** | You are a technical debt expert specializing in identifying, quantifying, and prioritizing technical debt in software projects. Analyze the codebase to uncover debt, assess its impact, and create acti |
| **codex-review** | — |
| **coding-standards** | — |
| **commit** | Create commit messages following Sentry conventions. Use when committing code changes, writing commit messages, or formatting git history. Follows conventional commits with Sentry-specific issue references. |
| **competitive-landscape** | — |
| **competitor-alternatives** | When the user wants to create competitor comparison or alternative pages for SEO and sales enablement. Also use when the user mentions 'alternative page,' 'vs page,' 'competitor comparison,' 'comparison page,' '[Product] vs [Product],' '[Product] alternative,' or 'competitive landing pages.' Covers four formats: singular alternative, plural alterna |
| **comprehensive-review-full-review** | Use when working with comprehensive review full review |
| **comprehensive-review-pr-enhance** | You are a PR optimization expert specializing in creating high-quality pull requests that facilitate efficient code reviews. Generate comprehensive PR descriptions, automate review processes, and ensure PRs follow best practices for clarity, size, and reviewability. |
| **computer-use-agents** | Build AI agents that interact with computers like humans do - viewing screens, moving cursors, clicking buttons, and typing text. Covers Anthropic's Computer Use, OpenAI's Operator/CUA, and open-source alternatives. Critical focus on sandboxing, security, and handling the unique challenges of vision-based control. Use when: computer use, desktop au |
| **computer-vision-expert** | — |
| **concise-planning** | — |
| **confluence-automation** | Automate Confluence page creation, content search, space management, labels, and hierarchy navigation via Rube MCP (Composio). Always search tools first for current schemas. |
| **context-compression** | Design and evaluate compression strategies for long-running sessions |
| **context-degradation** | Recognize patterns of context failure: lost-in-middle, poisoning, distraction, and clash |
| **context-driven-development** | — |
| **context-fundamentals** | Understand what context is, why it matters, and the anatomy of context in agent systems |
| **context-management-context-restore** | Use when working with context management context restore |
| **context-management-context-save** | Use when working with context management context save |
| **context-manager** | — |
| **context-optimization** | Apply compaction, masking, and caching strategies |
| **context-window-management** | Strategies for managing LLM context windows including summarization, trimming, routing, and avoiding context rot Use when: context window, token limit, context management, context engineering, long context. |
| **context7-auto-research** | — |
| **conversation-memory** | Persistent memory systems for LLM conversations including short-term, long-term, and entity-based memory Use when: conversation memory, remember, memory persistence, long-term memory, chat history. |
| **convertkit-automation** | Automate ConvertKit (Kit) tasks via Rube MCP (Composio): manage subscribers, tags, broadcasts, and broadcast stats. Always search tools first for current schemas. |
| **copilot-sdk** | — |
| **copy-editing** | When the user wants to edit, review, or improve existing marketing copy. Also use when the user mentions 'edit this copy,' 'review my copy,' 'copy feedback,' 'proofread,' 'polish this,' 'make this better,' or 'copy sweep.' This skill provides a systematic approach to editing marketing copy through multiple focused passes. |
| **core-components** | — |
| **cost-optimization** | — |
| **cpp-pro** | — |
| **cqrs-implementation** | — |
| **create-pr** | Create pull requests following Sentry conventions. Use when opening PRs, writing PR descriptions, or preparing changes for review. Follows Sentry's code review guidelines. |
| **crewai** | Expert in CrewAI - the leading role-based multi-agent framework used by 60% of Fortune 500 companies. Covers agent design with roles and goals, task definition, crew orchestration, process types (sequential, hierarchical, parallel), memory systems, and flows for complex workflows. Essential for building collaborative AI agent teams. Use when: crewa |
| **crypto-bd-agent** | — |
| **csharp-pro** | — |
| **culture-index** | Index and search culture documentation |
| **customer-support** | — |
| **d3-viz** | — |
| **daily-news-report** | — |
| **database-admin** | — |
| **database-architect** | — |
| **database-cloud-optimization-cost-optimize** | You are a cloud cost optimization expert specializing in reducing infrastructure expenses while maintaining performance and reliability. Analyze cloud spending, identify savings opportunities, and implement cost-effective architectures across AWS, Azure, and GCP. |
| **database-design** | — |
| **database-migration** | — |
| **database-migrations-migration-observability** | — |
| **database-optimizer** | — |
| **datadog-automation** | Automate Datadog tasks via Rube MCP (Composio): query metrics, search logs, manage monitors/dashboards, create events and downtimes. Always search tools first for current schemas. |
| **dbos-python** | — |
| **dbos-typescript** | — |
| **ddd-context-mapping** | — |
| **ddd-strategic-design** | — |
| **ddd-tactical-patterns** | — |
| **debugger** | — |
| **debugging-strategies** | — |
| **debugging-toolkit-smart-debug** | Use when working with debugging toolkit smart debug |
| **deep-research** | Execute autonomous multi-step research using Google Gemini Deep Research Agent. Use for: market analysis, competitive landscaping, literature reviews, technical research, due diligence. Takes 2-10 minutes but produces detailed, cited reports. Costs $2-5 per task. |
| **defi-protocol-templates** | — |
| **dependency-management-deps-audit** | You are a dependency security expert specializing in vulnerability scanning, license compliance, and supply chain security. Analyze project dependencies for known vulnerabilities, licensing issues, outdated packages, and provide actionable remediation strategies. |
| **dependency-upgrade** | — |
| **deployment-engineer** | — |
| **deployment-pipeline-design** | — |
| **deployment-procedures** | — |
| **deployment-validation-config-validate** | You are a configuration management expert specializing in validating, testing, and ensuring the correctness of application configurations. Create comprehensive validation schemas, implement configurat |
| **design-md** | Analyze Stitch projects and synthesize a semantic design system into DESIGN.md files |
| **design-orchestration** | — |
| **discord-automation** | Automate Discord tasks via Rube MCP (Composio): messages, channels, roles, webhooks, reactions. Always search tools first for current schemas. |
| **discord-bot-architect** | Specialized skill for building production-ready Discord bots. Covers Discord.js (JavaScript) and Pycord (Python), gateway intents, slash commands, interactive components, rate limiting, and sharding. |
| **dispatching-parallel-agents** | — |
| **distributed-debugging-debug-trace** | You are a debugging expert specializing in setting up comprehensive debugging environments, distributed tracing, and diagnostic tools. Configure debugging workflows, implement tracing solutions, and establish troubleshooting practices for development and production environments. |
| **distributed-tracing** | — |
| **docs-architect** | — |
| **documentation-generation-doc-generate** | You are a documentation expert specializing in creating comprehensive, maintainable documentation from code. Generate API docs, architecture diagrams, user guides, and technical references using AI-powered analysis and industry best practices. |
| **documentation-templates** | — |
| **docusign-automation** | Automate DocuSign tasks via Rube MCP (Composio): templates, envelopes, signatures, document management. Always search tools first for current schemas. |
| **docx** | Comprehensive document creation, editing, and analysis with support for tracked changes, comments, formatting preservation, and text extraction. When Claude needs to work with professional documents (.docx files) for: (1) Creating new documents, (2) Modifying or editing content, (3) Working with tracked changes, (4) Adding comments, or any other do |
| **domain-driven-design** | — |
| **dropbox-automation** | Automate Dropbox file management, sharing, search, uploads, downloads, and folder operations via Rube MCP (Composio). Always search tools first for current schemas. |
| **dx-optimizer** | — |
| **elixir-pro** | — |
| **email-sequence** | — |
| **email-systems** | Email has the highest ROI of any marketing channel. $36 for every $1 spent. Yet most startups treat it as an afterthought - bulk blasts, no personalization, landing in spam folders. This skill covers transactional email that works, marketing automation that converts, deliverability that reaches inboxes, and the infrastructure decisions that scale.  |
| **employment-contract-templates** | — |
| **environment-setup-guide** | Guide developers through setting up development environments with proper tools, dependencies, and configurations |
| **error-debugging-error-analysis** | You are an expert error analysis specialist with deep expertise in debugging distributed systems, analyzing production incidents, and implementing comprehensive observability solutions. |
| **error-debugging-error-trace** | You are an error tracking and observability expert specializing in implementing comprehensive error monitoring solutions. Set up error tracking systems, configure alerts, implement structured logging, and ensure teams can quickly identify and resolve production issues. |
| **error-detective** | — |
| **error-diagnostics-error-analysis** | You are an expert error analysis specialist with deep expertise in debugging distributed systems, analyzing production incidents, and implementing comprehensive observability solutions. |
| **error-diagnostics-error-trace** | You are an error tracking and observability expert specializing in implementing comprehensive error monitoring solutions. Set up error tracking systems, configure alerts, implement structured logging, |
| **error-diagnostics-smart-debug** | Use when working with error diagnostics smart debug |
| **error-handling-patterns** | — |
| **Ethical Hacking Methodology** | — |
| **evaluation** | Build evaluation frameworks for agent systems |
| **event-sourcing-architect** | Expert in event sourcing, CQRS, and event-driven architecture patterns. Masters event store design, projection building, saga orchestration, and eventual consistency patterns. Use PROACTIVELY for event-sourced systems, audit trails, or temporal queries. |
| **event-store-design** | — |
| **exa-search** | — |
| **executing-plans** | — |
| **expo-deployment** | Deploy Expo apps to production |
| **fal-audio** | Text-to-speech and speech-to-text using fal.ai audio models |
| **fal-generate** | Generate images and videos using fal.ai AI models |
| **fal-image-edit** | AI-powered image editing with style transfer and object removal |
| **fal-platform** | Platform APIs for model management, pricing, and usage tracking |
| **fal-upscale** | Upscale and enhance image and video resolution using AI |
| **fal-workflow** | Generate workflow JSON files for chaining AI models |
| **ffuf-claude-skill** | Web fuzzing with ffuf |
| **figma-automation** | Automate Figma tasks via Rube MCP (Composio): files, components, design tokens, comments, exports. Always search tools first for current schemas. |
| **file-organizer** | — |
| **file-uploads** | Expert at handling file uploads and cloud storage. Covers S3, Cloudflare R2, presigned URLs, multipart uploads, and image optimization. Knows how to handle large files without blocking. Use when: file upload, S3, R2, presigned URL, multipart. |
| **find-bugs** | Find bugs, security vulnerabilities, and code quality issues in local branch changes. Use when asked to review changes, find bugs, security review, or audit code on the current branch. |
| **finishing-a-development-branch** | — |
| **firebase** | Firebase gives you a complete backend in minutes - auth, database, storage, functions, hosting. But the ease of setup hides real complexity. Security rules are your last line of defense, and they're often wrong. Firestore queries are limited, and you learn this after you've designed your data model. This skill covers Firebase Authentication, Firest |
| **firecrawl-scraper** | — |
| **firmware-analyst** | — |
| **fix-review** | Verify fix commits address audit findings without new bugs |
| **form-cro** | — |
| **fp-ts-errors** | — |
| **fp-ts-pragmatic** | — |
| **framework-migration-code-migrate** | You are a code migration expert specializing in transitioning codebases between frameworks, languages, versions, and platforms. Generate comprehensive migration plans, automated migration scripts, and |
| **framework-migration-deps-upgrade** | You are a dependency management expert specializing in safe, incremental upgrades of project dependencies. Plan and execute dependency updates with minimal risk, proper testing, and clear migration pa |
| **framework-migration-legacy-modernize** | Orchestrate a comprehensive legacy system modernization using the strangler fig pattern, enabling gradual replacement of outdated components while maintaining continuous business operations through ex |
| **free-tool-strategy** | — |
| **freshdesk-automation** | Automate Freshdesk helpdesk operations including tickets, contacts, companies, notes, and replies via Rube MCP (Composio). Always search tools first for current schemas. |
| **freshservice-automation** | Automate Freshservice ITSM tasks via Rube MCP (Composio): create/update tickets, bulk operations, service requests, and outbound emails. Always search tools first for current schemas. |
| **full-stack-orchestration-full-stack-feature** | Use when working with full stack orchestration full stack feature |
| **game-art** | — |
| **game-audio** | — |
| **game-design** | — |
| **game-development** | — |
| **geo-fundamentals** | — |
| **git-advanced-workflows** | — |
| **git-pr-workflows-git-workflow** | Orchestrate a comprehensive git workflow from code review through PR creation, leveraging specialized agents for quality assurance, testing, and deployment readiness. This workflow implements modern g |
| **git-pr-workflows-onboard** | You are an **expert onboarding specialist and knowledge transfer architect** with deep experience in remote-first organizations, technical team integration, and accelerated learning methodologies. You |
| **git-pr-workflows-pr-enhance** | You are a PR optimization expert specializing in creating high-quality pull requests that facilitate efficient code reviews. Generate comprehensive PR descriptions, automate review processes, and ensu |
| **git-pushing** | — |
| **github-automation** | Automate GitHub repositories, issues, pull requests, branches, CI/CD, and permissions via Rube MCP (Composio). Manage code workflows, review PRs, search code, and handle deployments programmatically. |
| **github-issue-creator** | — |
| **github-workflow-automation** | Automate GitHub workflows with AI assistance. Includes PR reviews, issue triage, CI/CD integration, and Git operations. Use when automating GitHub workflows, setting up PR review automation, creating GitHub Actions, or triaging issues. |
| **gitlab-automation** | Automate GitLab project management, issues, merge requests, pipelines, branches, and user operations via Rube MCP (Composio). Always search tools first for current schemas. |
| **gitlab-ci-patterns** | — |
| **gitops-workflow** | — |
| **gmail-automation** | Automate Gmail tasks via Rube MCP (Composio): send/reply, search, labels, drafts, attachments. Always search tools first for current schemas. |
| **godot-gdscript-patterns** | — |
| **google-analytics-automation** | Automate Google Analytics tasks via Rube MCP (Composio): run reports, list accounts/properties, funnels, pivots, key events. Always search tools first for current schemas. |
| **google-calendar-automation** | Automate Google Calendar events, scheduling, availability checks, and attendee management via Rube MCP (Composio). Create events, find free slots, manage attendees, and list calendars programmatically. |
| **google-drive-automation** | Automate Google Drive file operations (upload, download, search, share, organize) via Rube MCP (Composio). Upload/download files, manage folders, share with permissions, and search across drives programmatically. |
| **googlesheets-automation** | Automate Google Sheets operations (read, write, format, filter, manage spreadsheets) via Rube MCP (Composio). Read/write data, manage tabs, apply formatting, and search rows programmatically. |
| **grafana-dashboards** | — |
| **graphql** | GraphQL gives clients exactly the data they need - no more, no less. One endpoint, typed schema, introspection. But the flexibility that makes it powerful also makes it dangerous. Without proper controls, clients can craft queries that bring down your server. This skill covers schema design, resolvers, DataLoader for N+1 prevention, federation for  |
| **graphql-architect** | — |
| **haskell-pro** | — |
| **helm-chart-scaffolding** | — |
| **helpdesk-automation** | Automate HelpDesk tasks via Rube MCP (Composio): list tickets, manage views, use canned responses, and configure custom fields. Always search tools first for current schemas. |
| **hosted-agents-v2-py** | — |
| **hr-pro** | — |
| **hubspot-automation** | Automate HubSpot CRM operations (contacts, companies, deals, tickets, properties) via Rube MCP using Composio integration. |
| **hubspot-integration** | Expert patterns for HubSpot CRM integration including OAuth authentication, CRM objects, associations, batch operations, webhooks, and custom objects. Covers Node.js and Python SDKs. Use when: hubspot, hubspot api, hubspot crm, hubspot integration, contacts api. |
| **hugging-face-cli** | Execute Hugging Face Hub operations using the `hf` CLI. Use when the user needs to download models/datasets/spaces, upload files to Hub repositories, create repos, manage local cache, or run compute jobs on HF infrastructure. Covers authentication, file transfers, repository creation, cache operations, and cloud compute. |
| **hugging-face-jobs** | This skill should be used when users want to run any workload on Hugging Face Jobs infrastructure. Covers UV scripts, Docker-based jobs, hardware selection, cost estimation, authentication with tokens, secrets management, timeout configuration, and result persistence. Designed for general-purpose compute workloads including data processing, inferen |
| **hybrid-cloud-architect** | — |
| **hybrid-cloud-networking** | — |
| **hybrid-search-implementation** | — |
| **i18n-localization** | — |
| **imagen** | — |
| **incident-responder** | — |
| **incident-response-incident-response** | Use when working with incident response incident response |
| **incident-response-smart-fix** | [Extended thinking: This workflow implements a sophisticated debugging and resolution pipeline that leverages AI-assisted debugging tools and observability platforms to systematically diagnose and res |
| **incident-runbook-templates** | — |
| **Infinite Gratitude** | — |
| **inngest** | Inngest expert for serverless-first background jobs, event-driven workflows, and durable execution without managing queues or workers. Use when: inngest, serverless background job, event-driven workflow, step function, durable execution. |
| **instagram-automation** | Automate Instagram tasks via Rube MCP (Composio): create posts, carousels, manage media, get insights, and publishing limits. Always search tools first for current schemas. |
| **interactive-portfolio** | Expert in building portfolios that actually land jobs and clients - not just showing work, but creating memorable experiences. Covers developer portfolios, designer portfolios, creative portfolios, and portfolios that convert visitors into opportunities. Use when: portfolio, personal website, showcase work, developer portfolio, designer portfolio. |
| **intercom-automation** | Automate Intercom tasks via Rube MCP (Composio): conversations, contacts, companies, segments, admins. Always search tools first for current schemas. |
| **internal-comms** | — |
| **ios-developer** | — |
| **istio-traffic-management** | — |
| **iterate-pr** | Iterate on a PR until CI passes. Use when you need to fix CI failures, address review feedback, or continuously push fixes until all checks are green. Automates the feedback-fix-push-wait cycle. |
| **java-pro** | — |
| **javascript-mastery** | Comprehensive JavaScript reference covering 33+ essential concepts every developer should know. From fundamentals like primitives and closures to advanced patterns like async/await and functional programming. Use when explaining JS concepts, debugging JavaScript issues, or teaching JavaScript fundamentals. |
| **javascript-pro** | — |
| **javascript-typescript-typescript-scaffold** | You are a TypeScript project architecture expert specializing in scaffolding production-ready Node.js and frontend applications. Generate complete project structures with modern tooling (pnpm, Vite, N |
| **jira-automation** | Automate Jira tasks via Rube MCP (Composio): issues, projects, sprints, boards, comments, users. Always search tools first for current schemas. |
| **julia-pro** | — |
| **kaizen** | — |
| **klaviyo-automation** | Automate Klaviyo tasks via Rube MCP (Composio): manage email/SMS campaigns, inspect campaign messages, track tags, and monitor send jobs. Always search tools first for current schemas. |
| **kpi-dashboard-design** | — |
| **langfuse** | Expert in Langfuse - the open-source LLM observability platform. Covers tracing, prompt management, evaluation, datasets, and integration with LangChain, LlamaIndex, and OpenAI. Essential for debugging, monitoring, and improving LLM applications in production. Use when: langfuse, llm observability, llm tracing, prompt management, llm evaluation. |
| **langgraph** | Expert in LangGraph - the production-grade framework for building stateful, multi-actor AI applications. Covers graph construction, state management, cycles and branches, persistence with checkpointers, human-in-the-loop patterns, and the ReAct agent pattern. Used in production at LinkedIn, Uber, and 400+ companies. This is LangChain's recommended  |
| **last30days** | — |
| **launch-strategy** | When the user wants to plan a product launch, feature announcement, or release strategy. Also use when the user mentions 'launch,' 'Product Hunt,' 'feature release,' 'announcement,' 'go-to-market,' 'beta launch,' 'early access,' 'waitlist,' or 'product update.' This skill covers phased launches, channel strategy, and ongoing launch momentum. |
| **legacy-modernizer** | — |
| **legal-advisor** | — |
| **linear-automation** | Automate Linear tasks via Rube MCP (Composio): issues, projects, cycles, teams, labels. Always search tools first for current schemas. |
| **linear-claude-skill** | Manage Linear issues, projects, and teams |
| **linkedin-automation** | Automate LinkedIn tasks via Rube MCP (Composio): create posts, manage profile, company info, comments, and image uploads. Always search tools first for current schemas. |
| **linkerd-patterns** | — |
| **lint-and-validate** | Automatic quality control, linting, and static analysis procedures. Use after every code modification to ensure syntax correctness and project standards. Triggers onKeywords: lint, format, check, validate, types, static analysis. |
| **Linux Privilege Escalation** | — |
| **Linux Production Shell Scripts** | — |
| **loki-mode** | — |
| **m365-agents-py** | — |
| **m365-agents-ts** | — |
| **mailchimp-automation** | Automate Mailchimp email marketing including campaigns, audiences, subscribers, segments, and analytics via Rube MCP (Composio). Always search tools first for current schemas. |
| **make-automation** | Automate Make (Integromat) tasks via Rube MCP (Composio): operations, enums, language and timezone lookups. Always search tools first for current schemas. |
| **makepad-skills** | Makepad UI development skills for Rust apps: setup, patterns, shaders, packaging, and troubleshooting. |
| **malware-analyst** | — |
| **market-sizing-analysis** | — |
| **mcp-builder** | — |
| **memory-forensics** | — |
| **memory-safety-patterns** | — |
| **memory-systems** | Design short-term, long-term, and graph-based memory architectures |
| **mermaid-expert** | — |
| **Metasploit Framework** | — |
| **micro-saas-launcher** | Expert in launching small, focused SaaS products fast - the indie hacker approach to building profitable software. Covers idea validation, MVP development, pricing, launch strategies, and growing to sustainable revenue. Ship in weeks, not months. Use when: micro saas, indie hacker, small saas, side project, saas mvp. |
| **microservices-patterns** | — |
| **microsoft-teams-automation** | Automate Microsoft Teams tasks via Rube MCP (Composio): send messages, manage channels, create meetings, handle chats, and search messages. Always search tools first for current schemas. |
| **minecraft-bukkit-pro** | — |
| **miro-automation** | Automate Miro tasks via Rube MCP (Composio): boards, items, sticky notes, frames, sharing, connectors. Always search tools first for current schemas. |
| **mixpanel-automation** | Automate Mixpanel tasks via Rube MCP (Composio): events, segmentation, funnels, cohorts, user profiles, JQL queries. Always search tools first for current schemas. |
| **mlops-engineer** | — |
| **mobile-design** | — |
| **mobile-developer** | — |
| **mobile-games** | — |
| **modern-javascript-patterns** | — |
| **monday-automation** | Automate Monday.com work management including boards, items, columns, groups, subitems, and updates via Rube MCP (Composio). Always search tools first for current schemas. |
| **monorepo-architect** | Expert in monorepo architecture, build systems, and dependency management at scale. Masters Nx, Turborepo, Bazel, and Lerna for efficient multi-project development. Use PROACTIVELY for monorepo setup, |
| **monorepo-management** | — |
| **mtls-configuration** | — |
| **multi-cloud-architecture** | — |
| **multi-platform-apps-multi-platform** | Build and deploy the same feature consistently across web, mobile, and desktop platforms using API-first architecture and parallel implementation strategies. |
| **multiplayer** | — |
| **n8n-code-python** | Write Python code in n8n Code nodes. Use when writing Python in n8n, using _input/_json/_node syntax, working with standard library, or need to understand Python limitations in n8n Code nodes. |
| **n8n-mcp-tools-expert** | Expert guide for using n8n-mcp MCP tools effectively. Use when searching for nodes, validating configurations, accessing templates, managing workflows, or using any n8n-mcp tool. Provides tool selection guidance, parameter formats, and common patterns. |
| **nanobanana-ppt-skills** | AI-powered PPT generation with document analysis and styled images |
| **Network 101** | — |
| **network-engineer** | — |
| **nft-standards** | — |
| **notebooklm** | — |
| **notion-automation** | Automate Notion tasks via Rube MCP (Composio): pages, databases, blocks, comments, users. Always search tools first for current schemas. |
| **notion-template-business** | Expert in building and selling Notion templates as a business - not just making templates, but building a sustainable digital product business. Covers template design, pricing, marketplaces, marketing, and scaling to real revenue. Use when: notion template, sell templates, digital product, notion business, gumroad. |
| **nx-workspace-patterns** | — |
| **observability-engineer** | — |
| **observability-monitoring-monitor-setup** | You are a monitoring and observability expert specializing in implementing comprehensive monitoring solutions. Set up metrics collection, distributed tracing, log aggregation, and create insightful da |
| **observability-monitoring-slo-implement** | You are an SLO (Service Level Objective) expert specializing in implementing reliability standards and error budget-based practices. Design SLO frameworks, define SLIs, and build monitoring that balances reliability with delivery velocity. |
| **observe-whatsapp** | Observe and troubleshoot WhatsApp in Kapso: debug message delivery, inspect webhook deliveries/retries, triage API errors, and run health checks. Use when investigating production issues, message failures, or webhook delivery problems. |
| **obsidian-clipper-template-creator** | — |
| **on-call-handoff-patterns** | — |
| **onboarding-cro** | — |
| **one-drive-automation** | Automate OneDrive file management, search, uploads, downloads, sharing, permissions, and folder operations via Rube MCP (Composio). Always search tools first for current schemas. |
| **oss-hunter** | — |
| **outlook-automation** | Automate Outlook tasks via Rube MCP (Composio): emails, calendar, contacts, folders, attachments. Always search tools first for current schemas. |
| **outlook-calendar-automation** | Automate Outlook Calendar tasks via Rube MCP (Composio): create events, manage attendees, find meeting times, and handle invitations. Always search tools first for current schemas. |
| **page-cro** | — |
| **pagerduty-automation** | Automate PagerDuty tasks via Rube MCP (Composio): manage incidents, services, schedules, escalation policies, and on-call rotations. Always search tools first for current schemas. |
| **paid-ads** | When the user wants help with paid advertising campaigns on Google Ads, Meta (Facebook/Instagram), LinkedIn, Twitter/X, or other ad platforms. Also use when the user mentions 'PPC,' 'paid media,' 'ad copy,' 'ad creative,' 'ROAS,' 'CPA,' 'ad campaign,' 'retargeting,' or 'audience targeting.' This skill covers campaign strategy, ad creation, audience |
| **parallel-agents** | — |
| **payment-integration** | — |
| **paypal-integration** | — |
| **paywall-upgrade-cro** | — |
| **pc-games** | — |
| **pdf** | — |
| **performance-engineer** | — |
| **performance-profiling** | — |
| **personal-tool-builder** | Expert in building custom tools that solve your own problems first. The best products often start as personal tools - scratch your own itch, build for yourself, then discover others have the same itch. Covers rapid prototyping, local-first apps, CLI tools, scripts that grow into products, and the art of dogfooding. Use when: build a tool, personal  |
| **pipedrive-automation** | Automate Pipedrive CRM operations including deals, contacts, organizations, activities, notes, and pipeline management via Rube MCP (Composio). Always search tools first for current schemas. |
| **plaid-fintech** | Expert patterns for Plaid API integration including Link token flows, transactions sync, identity verification, Auth for ACH, balance checks, webhook handling, and fintech compliance best practices. Use when: plaid, bank account linking, bank connection, ach, account aggregation. |
| **plan-writing** | — |
| **planning-with-files** | — |
| **podcast-generation** | — |
| **popup-cro** | — |
| **posix-shell-pro** | — |
| **posthog-automation** | Automate PostHog tasks via Rube MCP (Composio): events, feature flags, projects, user profiles, annotations. Always search tools first for current schemas. |
| **postmark-automation** | Automate Postmark email delivery tasks via Rube MCP (Composio): send templated emails, manage templates, monitor delivery stats and bounces. Always search tools first for current schemas. |
| **postmortem-writing** | — |
| **powershell-windows** | — |
| **pptx** | Presentation creation, editing, and analysis. When Claude needs to work with presentations (.pptx files) for: (1) Creating new presentations, (2) Modifying or editing content, (3) Working with layouts, (4) Adding comments or speaker notes, or any other presentation tasks |
| **pricing-strategy** | — |
| **Privilege Escalation Methods** | — |
| **production-code-audit** | Autonomously deep-scan entire codebase line-by-line, understand architecture and patterns, then systematically transform it to production-grade, corporate-level professional quality with optimizations |
| **projection-patterns** | — |
| **prometheus-configuration** | — |
| **protocol-reverse-engineering** | — |
| **pydantic-models-py** | — |
| **pypict-skill** | Pairwise test generation |
| **python-development-python-scaffold** | You are a Python project architecture expert specializing in scaffolding production-ready Python applications. Generate complete project structures with modern tooling (uv, FastAPI, Django), type hint |
| **python-packaging** | — |
| **python-patterns** | — |
| **python-performance-optimization** | — |
| **python-pro** | — |
| **quant-analyst** | — |
| **readme** | When the user wants to create or update a README.md file for a project. Also use when the user says 'write readme,' 'create readme,' 'document this project,' 'project documentation,' or asks for help with README.md. This skill creates absurdly thorough documentation covering local setup, architecture, and deployment. |
| **receiving-code-review** | — |
| **Red Team Tools and Methodology** | — |
| **red-team-tactics** | — |
| **reddit-automation** | Automate Reddit tasks via Rube MCP (Composio): search subreddits, create posts, manage comments, and browse top content. Always search tools first for current schemas. |
| **reference-builder** | — |
| **referral-program** | When the user wants to create, optimize, or analyze a referral program, affiliate program, or word-of-mouth strategy. Also use when the user mentions 'referral,' 'affiliate,' 'ambassador,' 'word of mouth,' 'viral loop,' 'refer a friend,' or 'partner program.' This skill covers program design, incentive structure, and growth optimization. |
| **remotion-best-practices** | — |
| **render-automation** | Automate Render tasks via Rube MCP (Composio): services, deployments, projects. Always search tools first for current schemas. |
| **requesting-code-review** | — |
| **research-engineer** | An uncompromising Academic Research Engineer. Operates with absolute scientific rigor, objective criticism, and zero flair. Focuses on theoretical correctness, formal verification, and optimal implementation across any required technology. |
| **reverse-engineer** | — |
| **risk-manager** | — |
| **risk-metrics-calculation** | — |
| **ruby-pro** | — |
| **rust-async-patterns** | — |
| **rust-pro** | — |
| **saga-orchestration** | — |
| **sales-automator** | — |
| **salesforce-automation** | Automate Salesforce tasks via Rube MCP (Composio): leads, contacts, accounts, opportunities, SOQL queries. Always search tools first for current schemas. |
| **salesforce-development** | Expert patterns for Salesforce platform development including Lightning Web Components (LWC), Apex triggers and classes, REST/Bulk APIs, Connected Apps, and Salesforce DX with scratch orgs and 2nd generation packages (2GP). Use when: salesforce, sfdc, apex, lwc, lightning web components. |
| **sast-configuration** | — |
| **scala-pro** | — |
| **screenshots** | Generate marketing screenshots of your app using Playwright. Use when the user wants to create screenshots for Product Hunt, social media, landing pages, or documentation. |
| **scroll-experience** | Expert in building immersive scroll-driven experiences - parallax storytelling, scroll animations, interactive narratives, and cinematic web experiences. Like NY Times interactives, Apple product pages, and award-winning web experiences. Makes websites feel like experiences, not just pages. Use when: scroll animation, parallax, scroll storytelling, |
| **search-specialist** | — |
| **secrets-management** | — |
| **segment-automation** | Automate Segment tasks via Rube MCP (Composio): track events, identify users, manage groups, page views, aliases, batch operations. Always search tools first for current schemas. |
| **segment-cdp** | Expert patterns for Segment Customer Data Platform including Analytics.js, server-side tracking, tracking plans with Protocols, identity resolution, destinations configuration, and data governance best practices. Use when: segment, analytics.js, customer data platform, cdp, tracking plan. |
| **sendgrid-automation** | Automate SendGrid email operations including sending emails, managing contacts/lists, sender identities, templates, and analytics via Rube MCP (Composio). Always search tools first for current schemas. |
| **senior-architect** | — |
| **senior-fullstack** | — |
| **sentry-automation** | Automate Sentry tasks via Rube MCP (Composio): manage issues/events, configure alerts, track releases, monitor projects and teams. Always search tools first for current schemas. |
| **server-management** | — |
| **service-mesh-expert** | Expert service mesh architect specializing in Istio, Linkerd, and cloud-native networking patterns. Masters traffic management, security policies, observability integration, and multi-cluster mesh con |
| **service-mesh-observability** | — |
| **sharp-edges** | Identify error-prone APIs and dangerous configurations |
| **shellcheck-configuration** | — |
| **shopify-apps** | Expert patterns for Shopify app development including Remix/React Router apps, embedded apps with App Bridge, webhook handling, GraphQL Admin API, Polaris components, billing, and app extensions. Use when: shopify app, shopify, embedded app, polaris, app bridge. |
| **shopify-automation** | Automate Shopify tasks via Rube MCP (Composio): products, orders, customers, inventory, collections. Always search tools first for current schemas. |
| **shopify-development** | — |
| **signup-flow-cro** | — |
| **similarity-search-patterns** | — |
| **skill-creator** | This skill should be used when the user asks to create a new skill, build a skill, make a custom skill, develop a CLI skill, or wants to extend the CLI with new capabilities. Automates the entire skill creation workflow from brainstorming to installation. |
| **skill-developer** | — |
| **skill-rails-upgrade** | Analyze Rails apps and provide upgrade assessments |
| **skill-seekers** | -Automatically convert documentation websites, GitHub repositories, and PDFs into Claude AI skills in minutes. |
| **slack-automation** | Automate Slack messaging, channel management, search, reactions, and threads via Rube MCP (Composio). Send messages, search conversations, manage channels/users, and react to messages programmatically. |
| **slack-bot-builder** | Build Slack apps using the Bolt framework across Python, JavaScript, and Java. Covers Block Kit for rich UIs, interactive components, slash commands, event handling, OAuth installation flows, and Workflow Builder integration. Focus on best practices for production-ready Slack apps. Use when: slack bot, slack app, bolt framework, block kit, slash co |
| **slack-gif-creator** | — |
| **slo-implementation** | — |
| **social-content** | When the user wants help creating, scheduling, or optimizing social media content for LinkedIn, Twitter/X, Instagram, TikTok, Facebook, or other platforms. Also use when the user mentions 'LinkedIn post,' 'Twitter thread,' 'social media,' 'content calendar,' 'social scheduling,' 'engagement,' or 'viral content.' This skill covers content creation,  |
| **software-architecture** | — |
| **spark-optimization** | — |
| **square-automation** | Automate Square tasks via Rube MCP (Composio): payments, orders, invoices, locations. Always search tools first for current schemas. |
| **startup-analyst** | — |
| **startup-business-analyst-business-case** | — |
| **startup-business-analyst-financial-projections** | — |
| **startup-business-analyst-market-opportunity** | — |
| **startup-financial-modeling** | — |
| **startup-metrics-framework** | — |
| **stride-analysis-patterns** | — |
| **stripe-automation** | Automate Stripe tasks via Rube MCP (Composio): customers, charges, subscriptions, invoices, products, refunds. Always search tools first for current schemas. |
| **stripe-integration** | — |
| **supabase-automation** | Automate Supabase database queries, table management, project administration, storage, edge functions, and SQL execution via Rube MCP (Composio). Always search tools first for current schemas. |
| **superpowers-lab** | Lab environment for Claude superpowers |
| **systematic-debugging** | — |
| **systems-programming-rust-project** | You are a Rust project architecture expert specializing in scaffolding production-ready Rust applications. Generate complete project structures with cargo tooling, proper module organization, testing |
| **tavily-web** | — |
| **tdd-orchestrator** | — |
| **tdd-workflow** | — |
| **tdd-workflows-tdd-cycle** | Use when working with tdd workflows tdd cycle |
| **tdd-workflows-tdd-green** | — |
| **tdd-workflows-tdd-red** | — |
| **tdd-workflows-tdd-refactor** | Use when working with tdd workflows tdd refactor |
| **team-collaboration-issue** | You are a GitHub issue resolution expert specializing in systematic bug investigation, feature implementation, and collaborative development workflows. Your expertise spans issue triage, root cause an |
| **team-collaboration-standup-notes** | You are an expert team communication specialist focused on async-first standup practices, AI-assisted note generation from commit history, and effective remote team coordination patterns. |
| **team-composition-analysis** | — |
| **telegram-automation** | Automate Telegram tasks via Rube MCP (Composio): send messages, manage chats, share photos/documents, and handle bot commands. Always search tools first for current schemas. |
| **telegram-bot-builder** | Expert in building Telegram bots that solve real problems - from simple automation to complex AI-powered bots. Covers bot architecture, the Telegram Bot API, user experience, monetization strategies, and scaling bots to thousands of users. Use when: telegram bot, bot api, telegram automation, chat bot telegram, tg bot. |
| **telegram-mini-app** | Expert in building Telegram Mini Apps (TWA) - web apps that run inside Telegram with native-like experience. Covers the TON ecosystem, Telegram Web App API, payments, user authentication, and building viral mini apps that monetize. Use when: telegram mini app, TWA, telegram web app, TON app, mini app. |
| **templates** | — |
| **temporal-python-pro** | — |
| **test-automator** | — |
| **test-driven-development** | — |
| **test-fixing** | — |
| **theme-factory** | — |
| **threat-mitigation-mapping** | — |
| **threat-modeling-expert** | Expert in threat modeling methodologies, security architecture review, and risk assessment. Masters STRIDE, PASTA, attack trees, and security requirement extraction. Use for security architecture reviews, threat identification, and secure-by-design planning. |
| **tiktok-automation** | Automate TikTok tasks via Rube MCP (Composio): upload/publish videos, post photos, manage content, and view user profiles/stats. Always search tools first for current schemas. |
| **todoist-automation** | Automate Todoist task management, projects, sections, filtering, and bulk operations via Rube MCP (Composio). Always search tools first for current schemas. |
| **tool-design** | Build tools that agents can use effectively, including architectural reduction patterns |
| **Top 100 Web Vulnerabilities Reference** | — |
| **trello-automation** | Automate Trello boards, cards, and workflows via Rube MCP (Composio). Create cards, manage lists, assign members, and search across boards programmatically. |
| **trigger-dev** | Trigger.dev expert for background jobs, AI workflows, and reliable async execution with excellent developer experience and TypeScript-first design. Use when: trigger.dev, trigger dev, background task, ai background job, long running task. |
| **turborepo-caching** | — |
| **tutorial-engineer** | — |
| **twilio-communications** | Build communication features with Twilio: SMS messaging, voice calls, WhatsApp Business API, and user verification (2FA). Covers the full spectrum from simple notifications to complex IVR systems and multi-channel authentication. Critical focus on compliance, rate limits, and error handling. Use when: twilio, send SMS, text message, voice call, pho |
| **twitter-automation** | Automate Twitter/X tasks via Rube MCP (Composio): posts, search, users, bookmarks, lists, media. Always search tools first for current schemas. |
| **typescript-advanced-types** | — |
| **typescript-expert** | — |
| **typescript-pro** | — |
| **unity-developer** | — |
| **unity-ecs-patterns** | — |
| **unreal-engine-cpp-pro** | — |
| **upgrading-expo** | Upgrade Expo SDK versions |
| **upstash-qstash** | Upstash QStash expert for serverless message queues, scheduled jobs, and reliable HTTP-based task delivery without managing infrastructure. Use when: qstash, upstash queue, serverless cron, scheduled http, message queue serverless. |
| **using-git-worktrees** | — |
| **using-neon** | Guides and best practices for working with Neon Serverless Postgres. Covers getting started, local development with Neon, choosing a connection method, Neon features, authentication (@neondatabase/auth), PostgREST-style data API (@neondatabase/neon-js), Neon CLI, and Neon's Platform API/SDKs. Use for any Neon-related questions. |
| **using-superpowers** | — |
| **uv-package-manager** | — |
| **varlock-claude-skill** | Secure environment variable management ensuring secrets are never exposed in Claude sessions, terminals, logs, or git commits |
| **vector-index-tuning** | — |
| **vercel-automation** | Automate Vercel tasks via Rube MCP (Composio): manage deployments, domains, DNS, env vars, projects, and teams. Always search tools first for current schemas. |
| **vercel-deploy-claimable** | Deploy applications and websites to Vercel. Use this skill when the user requests deployment actions such as 'Deploy my app', 'Deploy this to production', 'Create a preview deployment', 'Deploy and give me the link', or 'Push this live'. No authentication required - returns preview URL and claimable deployment link. |
| **vercel-deployment** | Expert knowledge for deploying to Vercel with Next.js Use when: vercel, deploy, deployment, hosting, production. |
| **verification-before-completion** | — |
| **vexor** | Vector-powered CLI for semantic file search with a Claude/Codex skill |
| **viral-generator-builder** | Expert in building shareable generator tools that go viral - name generators, quiz makers, avatar creators, personality tests, and calculator tools. Covers the psychology of sharing, viral mechanics, and building tools people can't resist sharing with friends. Use when: generator tool, quiz maker, name generator, avatar creator, viral tool. |
| **voice-agents** | Voice agents represent the frontier of AI interaction - humans speaking naturally with AI systems. The challenge isn't just speech recognition and synthesis, it's achieving natural conversation flow with sub-800ms latency while handling interruptions, background noise, and emotional nuance. This skill covers two architectures: speech-to-speech (Ope |
| **voice-ai-development** | Expert in building voice AI applications - from real-time voice agents to voice-enabled apps. Covers OpenAI Realtime API, Vapi for voice agents, Deepgram for transcription, ElevenLabs for synthesis, LiveKit for real-time infrastructure, and WebRTC fundamentals. Knows how to build low-latency, production-ready voice experiences. Use when: voice ai,  |
| **voice-ai-engine-development** | Build real-time conversational AI voice engines using async worker pipelines, streaming transcription, LLM agents, and TTS synthesis with interrupt handling and multi-provider support |
| **vr-ar** | — |
| **web-artifacts-builder** | — |
| **web-design-guidelines** | — |
| **web-games** | — |
| **web-performance-optimization** | Optimize website and web application performance including loading speed, Core Web Vitals, bundle size, caching strategies, and runtime performance |
| **webflow-automation** | Automate Webflow CMS collections, site publishing, page management, asset uploads, and ecommerce orders via Rube MCP (Composio). Always search tools first for current schemas. |
| **whatsapp-automation** | Automate WhatsApp Business tasks via Rube MCP (Composio): send messages, manage templates, upload media, and handle contacts. Always search tools first for current schemas. |
| **wiki-architect** | — |
| **wiki-onboarding** | — |
| **wiki-page-writer** | One-line description |
| **wiki-qa** | — |
| **wiki-researcher** | — |
| **wiki-vitepress** | — |
| **Windows Privilege Escalation** | — |
| **Wireshark Network Traffic Analysis** | — |
| **workflow-automation** | Workflow automation is the infrastructure that makes AI agents reliable. Without durable execution, a network hiccup during a 10-step payment flow means lost money and angry customers. With it, workflows resume exactly where they left off. This skill covers the platforms (n8n, Temporal, Inngest) and patterns (sequential, parallel, orchestrator-work |
| **workflow-orchestration-patterns** | — |
| **workflow-patterns** | — |
| **wrike-automation** | Automate Wrike project management via Rube MCP (Composio): create tasks/folders, manage projects, assign work, and track progress. Always search tools first for current schemas. |
| **writing-skills** | — |
| **x-article-publisher-skill** | Publish articles to X/Twitter |
| **xlsx** | Comprehensive spreadsheet creation, editing, and analysis with support for formulas, formatting, data analysis, and visualization. When Claude needs to work with spreadsheets (.xlsx, .xlsm, .csv, .tsv, etc) for: (1) Creating new spreadsheets with formulas and formatting, (2) Reading or analyzing data, (3) Modify existing spreadsheets while preservi |
| **youtube-automation** | Automate YouTube tasks via Rube MCP (Composio): upload videos, manage playlists, search content, get analytics, and handle comments. Always search tools first for current schemas. |
| **youtube-summarizer** | Extract transcripts from YouTube videos and generate comprehensive, detailed summaries using intelligent analysis frameworks |
| **zapier-make-patterns** | No-code automation democratizes workflow building. Zapier and Make (formerly Integromat) let non-developers automate business processes without writing code. But no-code doesn't mean no-complexity - these platforms have their own patterns, pitfalls, and breaking points. This skill covers when to use which platform, how to build reliable automations |
| **zendesk-automation** | Automate Zendesk tasks via Rube MCP (Composio): tickets, users, organizations, replies. Always search tools first for current schemas. |
| **zoho-crm-automation** | Automate Zoho CRM tasks via Rube MCP (Composio): create/update records, search contacts, manage leads, and convert leads. Always search tools first for current schemas. |
| **zoom-automation** | Automate Zoom meeting creation, management, recordings, webinars, and participant tracking via Rube MCP (Composio). Always search tools first for current schemas. |
| **zustand-store-ts** | — |

---

## By trigger (workspace WordPress skills)

Quick lookup by keyword or intent for **WordPress** skills in this repo.

| Trigger / intent | Skill |
|------------------|--------|
| Classify WordPress repo, route to right skill | wordpress-router |
| Abilities API, wp_register_ability, permissions | wp-abilities-api |
| Gutenberg blocks, block.json, render_callback | wp-block-development |
| Block themes, theme.json, templates, patterns | wp-block-themes |
| Interactivity API, data-wp-*, @wordpress/interactivity | wp-interactivity-api |
| WP performance, profiling, Query Monitor, caching | wp-performance |
| PHPStan in WordPress, phpstan.neon, baselines | wp-phpstan |
| WordPress Playground, blueprints, wp-env | wp-playground |
| Plugins, hooks, Settings API, release packaging | wp-plugin-development |
| Inspect WP repo, tooling/tests, JSON report | wp-project-triage |
| REST API, register_rest_route, show_in_rest | wp-rest-api |
| WP-CLI, search-replace, db export, cron | wp-wpcli-and-ops |
| WPDS, design system, components, tokens | wpds |

---

## How to add more skills to this reference

- **Workspace skills**: Skills live under `.cursor/skills/` (including `antigravity-awesome-skills/skills/`). Each `SKILL.md` has YAML frontmatter with `name` and `description` (when to use). To regenerate this doc after adding or changing skills, run a script that finds all `SKILL.md` files, parses the frontmatter, groups by domain, and outputs the markdown tables.
- **Domain grouping**: The script that generated this doc assigns each skill to WordPress, Frontend, Backend, Data, Cloud, Security, Content, AI, Product, or Misc based on path and name; you can adjust the grouping logic and re-run.
