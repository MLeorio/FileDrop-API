<?php

namespace App\Repositories;

use App\Models\Document;
use App\Interfaces\DocumentRepositoryInterface;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function index()
    {
        return Document::all();
    }

    public function getById($id)
    {
        return Document::findOrFail($id);
    }

    public function store(array $document)
    {
        return Document::create($document);
    }

    public function update(array $document, $id)
    {
        return Document::whereId( $id )->update($document);
    }

    public function delete($id)
    {
        return Document::destroy($id);
    }
}
