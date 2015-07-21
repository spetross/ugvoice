<?php namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;

class AssetController extends AppController
{


    public function __construct(FileRepository $fileRepository)
    {
        parent::__construct();
        $this->fileProvider = $fileRepository;
    }


    /**
     * Store uploaded file
     * @param Request $request
     * @return \Response
     * @throws ValidationException
     */
    public function store()
    {
        try {
            $file = $this->fileProvider->upload($this->request->file('file_data'));
            $result = $file;
        } catch (\Exception $ex) {
            $result = json_encode(['error' => $ex->getMessage()]);
            throw $ex;
        }
        header('Content-Type: application/json');
        die($result);
    }

    /**
     * Sort specified asset
     *
     * @return null
     */
    public function sort()
    {
        if ($this->request->has('sortOrder')) {
            $sortData = $this->request->input('sortOrder');
            $ids = array_keys($sortData);
            $orders = array_values($sortData);

            $file = new File();
            if ($file->exists)
                $file->setSortableOrder($ids, $orders);
            return;
        }
    }

    /**
     * Show the form for editing the specified file meta.
     *
     * @param  int $id
     * @return \Response
     * @throws \Exception
     */
    public function edit($id)
    {
        $file = File::find($id);
        if ($file) {
            return $this->theme->ofWithLayout('partials.file_config_form', compact('file'));
        }
        throw new \Exception('Unable to find file, it may no longer exist');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $file = $this->fileProvider->findById($id);
        $file->delete();
    }
}
