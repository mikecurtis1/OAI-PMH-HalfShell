# OAI-PMH-HalfShell

A minimal implementation OAI-PMH repository

* [OAI Protocol](http://www.openarchives.org/OAI/openarchivesprotocol.html)
* [Minimal Repository Implementation](http://www.openarchives.org/OAI/2.0/guidelines-repository.htm#MinimalImplementation)

## Supported Verbs

* [GetRecord](http://www.openarchives.org/OAI/openarchivesprotocol.html#GetRecord)
* [Identify](http://www.openarchives.org/OAI/openarchivesprotocol.html#Identify)
* [ListIdentifiers](http://www.openarchives.org/OAI/openarchivesprotocol.html#ListIdentifiers)
* [ListMetadataFormats](http://www.openarchives.org/OAI/openarchivesprotocol.html#ListMetadataFormats)
* [ListRecords](http://www.openarchives.org/OAI/openarchivesprotocol.html#ListRecords)
* [ListSets](http://www.openarchives.org/OAI/openarchivesprotocol.html#ListSets)

## Supported Metadata Formats

* [Dublin Core](http://www.openarchives.org/OAI/openarchivesprotocol.html#dublincore)

## Unique Identifier

See: [Definitions and Concepts 2.4 Unique Idenfifier](http://www.openarchives.org/OAI/openarchivesprotocol.html#UniqueIdentifier)

`<identifier> ::= "urn:" <domain-name> "/" <database-name> ":" <table-name> ":" <internal-id>`

ex. `urn:example.com/half_shell:books:BK160`

## Set Specification

HalfShell supports a two-level set heirarchy: `root_set` and `sub_set`.
