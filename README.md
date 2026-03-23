# OAI-PMH-HalfShell

A minimal implementation of an OAI-PMH (Open Archives Initiative Protocol for Metadata Harvesting) repository, designed to demonstrate core protocol functionality in a lightweight, containerized environment.

The project focuses on clarity of design and protocol behavior rather than full production complexity.

---

## Features

- Supports core OAI-PMH verbs:
  - Identify
  - GetRecord
  - ListIdentifiers
  - ListRecords
  - ListMetadataFormats
  - ListSets

- Dublin Core (`oai_dc`) metadata format
- Date range filtering (`from`, `until`)
- Set-based filtering
- Persistent deleted record support (`status="deleted"`)
- MySQL-backed data model
- Fully containerized with Docker and Docker Compose

---

## Architecture

This project follows a simple MVC (Model-View-Controller) pattern:

- **Model**  
  Handles data access and SQL queries. Each OAI verb maps to a corresponding model.

- **View**  
  Responsible for generating XML responses based on OAI-PMH specifications.

- **Controller**  
  Parses HTTP requests, routes based on the `verb` parameter, and coordinates Model and View interaction.

---

## Getting Started

### Prerequisites

- Docker
- Docker Compose

---

### Run the application

```bash
docker compose up --build


Once running, access the API at:

http://localhost:8082/index.php
