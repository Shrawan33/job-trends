<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentDataTable;
use App\Events\ImageResize;
use App\Http\Requests\AudioRequest;
use App\Http\Requests\CreateDocumentRequest;
use App\Http\Requests\VideoRequest;
use App\Models\Document;
use App\Repositories\DocumentRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Throwable;

class DocumentController extends AppBaseController
{
    private $documentRepository;
    private $endpoint;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->documentRepository = $documentRepo;
    }

    // public function index(DocumentDataTable $documentDataTable)
    // {
    //     return $documentDataTable->render('documents.index');
    // }

    public function create(CreateDocumentRequest $request)
    {
        $file = $request->file('file_name');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $filecontent = file_get_contents($file->getRealPath());
        //dd($request->get('disk', 's3'));
        $this->documentRepository->setDisk($request->get('disk', 's3'));

        $filepath = $this->documentRepository->saveTemp($name, $filecontent);

        return response()->json(array_merge([
            'name' => $name,
            'original_name' => $file->getClientOriginalName()
        ], $filepath));
    }

    public function video(VideoRequest $request)
    {
        $file = $request->file('file_name');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $filecontent = file_get_contents($file->getRealPath());

        $this->documentRepository->setDisk($request->get('disk', 's3'));

        $filepath = $this->documentRepository->saveTemp($name, $filecontent);

        return response()->json(array_merge([
            'name' => $name,
            'original_name' => $file->getClientOriginalName()
        ], $filepath));
    }

    public function audio(AudioRequest $request)
    {
        $file = $request->file('file_name');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $filecontent = file_get_contents($file->getRealPath());

        $this->documentRepository->setDisk($request->get('disk', 's3'));

        $filepath = $this->documentRepository->saveTemp($name, $filecontent);

        return response()->json(array_merge([
            'name' => $name,
            'original_name' => $file->getClientOriginalName()
        ], $filepath));
    }

    // public function ckEditorUpload(Request $request)
    // {
    //     if ($request->hasFile('upload')) {
    //         $file = $request->file('upload');

    //         $originName = $file->getClientOriginalName();
    //         $fileName = pathinfo($originName, PATHINFO_FILENAME);
    //         $extension = $file->getClientOriginalExtension();
    //         $fileName = $fileName . '_' . time() . '.' . $extension;

    //         $filecontent = file_get_contents($file->getRealPath());

    //         $this->documentRepository->setDisk($request->get('disk', 's3'));

    //         $filepath = $this->documentRepository->saveTemp($fileName, $filecontent);

    //         $url = asset('upload/images/' . $fileName);

    //         $CKEditorFuncNum = $request->input('CKEditorFuncNum');
    //         $msg = 'Image uploaded successfully';
    //         $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

    //         @header('Content-type: text/html; charset=utf-8');
    //         echo $response;
    //     }
    // }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'file_name' => 'required',
            'disk' => 'required'
        ]);

        $this->documentRepository->setDisk($validated['disk']);

        $this->documentRepository->deleteTemp($validated['file_name']);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $document = $this->documentRepository->find($id, ['*'], true);

        if (empty($document)) {
            Flash::error('Document not found');
            return redirect(route('documents.index'));
        }
        return view('documents.show')->with('document', $document);
    }

    public function download($id)
    {
        try {
            $document = $this->documentRepository->find($id, ['*'], true);

            if (empty($document)) {
                Flash::error('Document not found');
                return redirect()->back();
            }
            $this->documentRepository->setDisk($document->disk);
            $result = $this->documentRepository->downloadUrl($document->file_path);
            header('Content-length:' . $result['ContentLength']);
            header("Content-Type: {$result['ContentType']}");
            header('Content-Disposition: attachment; filename="' . basename($document->file_path) . '"'); // used to download the file.

            echo $result['Body'];
            exit();
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            // return redirect()->back();
        }

        return redirect()->back();
    }

    public function makeThumbnail() {
        $documents = $this->documentRepository->makeThumbnail();
        if ($documents) {
            foreach ($documents as $key => $document) {
                event(new ImageResize($document->id, []));
            }
        }
        dd($documents);
    }
}
