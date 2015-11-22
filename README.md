# OAI-PMH-HalfShell

A minimal implementation OAI-PMH repository

* [OAI Protocol](http://www.openarchives.org/OAI/openarchivesprotocol.html)
* [Minimal Repository Implementation](http://www.openarchives.org/OAI/2.0/guidelines-repository.htm#MinimalImplementation)

## Supported Verbs

1. GetRecord
2. Identify
3. ListIdentifiers
4. ListMetadataFormats
5. ListRecords
6. ListSets

## Supported Metadata Formats

1. Dublin Core

## Unique Identifier

See: [Definitions and Concepts 2.4 Unique Idenfifier](http://www.openarchives.org/OAI/openarchivesprotocol.html#UniqueIdentifier)

`<identifier> ::= "urn:" <domain-name> "/" <database-name> ":" <table-name> ":" <internal-id>`

ex. `urn:example.com/half_shell:books:BK160`

## Set Specification

HalfShell supports a two-level set heirarchy: `root_set` and `sub_set`.
