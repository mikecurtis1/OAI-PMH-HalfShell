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

- Dublin Core (URL param `metadataPrefix=oai_dc`) metadata format
- Date range filtering (URL params `from`, `until`)
- Set-based filtering (URL param `set`)
- Persistent deleted record support (XML attribute `status="deleted"`)
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
```

Once running, access the API at:

* http://localhost:8082/index.php

### Example Requests

#### Identify
* http://localhost:8082/index.php?verb=Identify

#### ListMetadataFormats
* http://localhost:8082/index.php?verb=ListMetadataFormats

#### ListSets
* http://localhost:8082/index.php?verb=ListSets

#### GetRecord
* http://localhost:8082/index.php?verb=GetRecord&identifier=identifier&metadataPrefix=oai_dc

#### ListIdentifiers
* http://localhost:8082/index.php?verb=ListIdentifiers&metadataPrefix=oai_dc

* Optional parameters:
  * from=`<UTCdatetime>`
  * until=`<UTCdatetime>`
  * set=`<setSpec>`

#### ListRecords
* http://localhost:8082/index.php?verb=ListRecords&metadataPrefix=oai_dc

* Optional parameters:
  * from=`<UTCdatetime>`
  * until=`<UTCdatetime>`
  * set=`<setSpec>`

Example:

* http://localhost:8082/index.php?verb=ListRecords&metadataPrefix=oai_dc&from=2026-02-07+00:00:00&until=2026-05-31+00:00:00&set=2:0

### Data Model Notes

* Records are stored in MySQL and accessed via model classes.
* Sets are implemented as a two-level hierarchy (root_set, sub_set).
* Deleted records are retained and exposed via OAI-PMH status="deleted".

### Project Structure

```
OAI-PMH-HalfShell/
├── Dockerfile
├── docker-compose.yml
├── README.md
├── LICENSE.md
├── .gitignore
├── .dockerignore
└── src/
    ├── Controller/
    ├── Models/
    ├── View/
    ├── public/
    ├── sql/
    └── bootstrap.php
```

### Design Notes

This project implements a minimal OAI-PMH repository based on:

* http://www.openarchives.org/OAI/openarchivesprotocol.html
* http://www.openarchives.org/OAI/2.0/guidelines-repository.htm#MinimalImplementation

The name "HalfShell" is a reference to:

* The common nickname “OAI = oyster”
* A “half-shell” implementation focusing on core functionality
