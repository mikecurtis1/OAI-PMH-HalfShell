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

See: [Definitions and Concepts 2.6 Set](http://www.openarchives.org/OAI/openarchivesprotocol.html#Set)

HalfShell supports a two-level set heirarchy: `root_set` and `sub_set`.

## Deleted Records

See: [2.5.1 Deleted records](http://www.openarchives.org/OAI/openarchivesprotocol.html#DeletedRecords)  
See: [Best Practices for OAI... at Digital Library Federation](http://webservices.itcs.umich.edu/mediawiki/oaibp/index.php/Deleted_Record_Example_1)

Half-Shell supports persistent deleted records. If a record's status field is set to 0 (zero) its 
header tag will contain the `status="deleted"` attribute.