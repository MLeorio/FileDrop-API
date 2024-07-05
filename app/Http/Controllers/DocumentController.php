<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Classes\ApiResponseClass;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DocumentResource;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Interfaces\DocumentRepositoryInterface;

class DocumentController extends Controller
{
    private DocumentRepositoryInterface $documentRepositoryInterface;

    public function __construct(DocumentRepositoryInterface $documentRepositoryInterface)
    {
        $this->documentRepositoryInterface = $documentRepositoryInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docs = $this->documentRepositoryInterface->index();

        return ApiResponseClass::sendResponse(DocumentResource::collection($docs), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        if ($request->hasFile('file')) {
            // Recuperation du fichier soumis
            $file = $request->file('file');

            //Generer un nom unique au fichier
            $filename = time() . '_' . $request->document_label . $request->file->extenxion;
            $file_extension = $file->getClientOriginalExtension();
            $file_size = $file->getSize();

            $path = $file->storeAs("upload/docs", $filename);
        }

        $details = [
            "document_label" => $request->document_label,
            "document_url" => $path,
            "document_type" => $file_extension,
            "document_size" => $file_size,
            "document_description" => $request->document_description
        ];

        DB::beginTransaction();
        try {
            $doc = $this->documentRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new DocumentResource($doc), 'Document ajouté avec succès', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $doc = $this->documentRepositoryInterface->getById($document);

        return ApiResponseClass::sendResponse(new DocumentResource($doc),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
