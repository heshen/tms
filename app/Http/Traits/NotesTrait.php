<?php
/**
 * Created by PhpStorm.
 * User: freddy
 * Date: 2017/8/9
 * Time: 10:41
 */

namespace App\Http\Traits;
use App\Model\Folder;
use App\Model\Notes;
use Illuminate\Support\Facades\Validator;
trait NotesTrait
{
    /**
     * 验证插入
     * @param array $data
     * @return bool|\Illuminate\Http\JsonResponse
     */
    protected function validateData (array $data)
    {
        // 验证规则
        $rules =  [
            'title' => 'required',
            'f_id' => 'required',
            'content' => 'max:'.(pow(2,32)-10),
            'origin_content' => 'max:'.(pow(2,32)-10)
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $this->ajaxError('参数验证输错',$validator->errors());
        }
        return true;
    }

    /**
     * 插入笔记
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    protected function insertNote ($params)
    {
        $notes = new Notes();
        $count = $notes->like('title',$params['title'])->where(['f_id'=>$params['f_id']])->count();
        if ($count > 0) {
            $params['title'] = $params['title'].'('.$count.')';
        }
        $username = user()->name;
        $params['u_id'] = user()->id;
        $params['last_updated_name'] = $username;
        $data = $notes->create($params);
        $data->author = $username;
        return $data;

    }

    /**
     * 更新数据
     * @param $params
     * @return mixed
     */
    protected function updateData ($params)
    {

        if (isset($params['title'])) {
            $count = Notes::where(['f_id'=>$params['f_id']])
                ->where('id','!=',$params['id'])
                ->like('title',$params['title'])
                ->count();
            if ($count > 0) {
                $params['title'] = $params['title'].'('.($count+1).')';
            }
        }
        $params['last_updated_name'] = user()->name;

        $data = Notes::where(array('id'=>$params['id'],'f_id'=>$params['f_id']))->update($params);
        return $data;
    }


    /**
     * 验证文档Id是否存在
     * @param $id
     * @return bool
     */
    protected function findFolderId($id)
    {
        return Folder::find($id) ? true : false;
    }

    /**
     * 验证文件夹所属的群组是否是公开
     * @param $id
     * @return bool
     */
    protected function checkFolderIsPrivate($id)
    {
        dd(Folder::find($id)->toArray());
        return Folder::find($id)->type == 0;
    }

    protected function getLatest()
    {
        $notes = new Notes();

        $latest = $notes->isPrivate()
            ->join('users','notes.u_id','=','users.id')
            ->select('notes.*', 'users.name as author')
            ->orderBy('updated_at','desc')
            ->limit($this->pagesize)
            ->get()->toArray();
        return $latest;
    }
}