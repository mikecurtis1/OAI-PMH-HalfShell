<?php 

class ModelListRecords extends ModelListIdentifiers implements ModelInterface
{
    /**
    * Model for the OAI-PMH ListRecords verb.
    *
    * Extends ModelListIdentifiers to reuse shared query logic.
    * Both verbs accept the same request parameters and operate on the same dataset.
    *
    * ListRecords differs only in response formatting, returning full record metadata
    * instead of identifier headers.
    */
}
