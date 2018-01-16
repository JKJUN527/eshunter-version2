<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/23
 * Time: 15:05
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Helper\Table;

class StudentController extends Controller
{
    public function test1()
    {
        //查询
//        $student = DB::select('select * from student');
//        var_dump($student);
//        dd($student);
        //新增
        //$bool = DB::insert('insert into student(name,age) values(?,?)',['jkjun',18]);
        //var_dump($bool);
        //更新
//        $num = DB::update('update student set age = ? where name = ?',[20,'jkjun']);
//        var_dump($num);
        //删除
        $num = DB::delete('delete from student where id =4');
        print($num);
    }
    public function query1()
    {
        //查询构造器
        //插入数据
//        $bool = DB::table('student')->insert(
//            ['name' => 'imooc','age' => 18]
//        );
//        var_dump($bool);
//        $id =DB::table('student')->insertGetId(
//            ['name' =>'sean','age' => 18]
//        );
//        var_dump($id);
//        DB::table('student')->insert(
//            [],
//            []
//        );
        //更新数据,更新数据要带条件
//       $num = DB::table('student')
//           ->where('id',7)
//           ->update(['age' => 50]);
//        var_dump($num);
        //$num = DB::table('student')->increment('age');//对字段值自增1
        //$num = DB::table('student')->increment('age',3);//对字段值自增3
        //$num = DB::table('student')->decrement('age');//对字段值自减1
        var_dump($num);
    }
    public function query2()
    {
//        $num = DB::table('student')
//            ->where('id',6)
//            ->delete();
//        $num = DB::table('student')
//            ->where('id','>=',6)
//            ->delete();
//        var_dump($num);
        DB::table('student')->truncate();//清空数据表，无返回值
    }
    public function query3()
    {
        //get() first() where() pluck() lists() select() chunk()
//        $bool = DB::table('student')->insert([
//            ['id' => 1006,'name' => 'name6','age' => 24],
//            ['id' => 1002,'name' => 'name2','age' => 19],
//            ['id' => 1003,'name' => 'name3','age' => 20],
//            ['id' => 1004,'name' => 'name4','age' => 22],
//            ['id' => 1005,'name' => 'name5','age' => 23]
//        ]);
//        var_dump($bool);

        //get()
        //$students = DB::table('student')->get();

        //first() 排序orderBy()
//        $students = DB::table('student')
//            ->orderBy('id','desc')
//            ->first();

        //where
//        $students = DB::table('student')
//            ->where('id','>=',1003)
//            ->get();
//        $students = DB::table('student')
//            ->whereRaw('id >=? and age>?',[1003,22])
//            ->get();

        //pluck
//        $names = DB::table('student')
//            ->pluck('name');

        //lists
//        $names = DB::table('student')
//            ->lists('name');//指定id作为下标

        //select
//        $names = DB::table('student')
//            ->select('id','name','age')
//            ->get();
//        dd($names);
        //chunk  分段获取数据
        echo '<pre>';//格式化输出
        DB::table('student')
            ->orderBy('id','desc')
            ->chunk(4, function ($students) {
            var_dump($students);
                return false;
        });
    }
    public function query4()
    {
        //聚合函数 count() max() min() avg() sum()
        //count()
//        $num = DB::table('student')
//            ->count();
        //max()
//        $max = DB::table('student')
//            ->max('name');
//        $min = DB::table('student')
//            ->min('age');
//        print $max;
//        print $min;
    }
    //ORM查询
    public function orm1()
    {
        echo '<pre>';
        //all()
//        $students = Student::all();
//        var_dump($students);

        //find()
//        $student = Student::find(1003);

        //findOrFail() //根据主键查询，没有查到就报错
//        $student = Student::findOrFail(1009);

//        $students = Student::get();
        $students = Student::where('id','>','1003')
            ->orderBy('id','desc')
            ->get();
        dd($students);
        //dd(response()->json($students));//json 响应
    }
    public function orm2(){
        //使用模型新增数据
//        $student = new Student();
//        $student->name = 'jiangjunliang';
//        $student->age = 20;
//        $student->save();
//        dd($student);
        //使用模型更新数据
//        $student = Student::find(1007);
//        $student->name = 'jjl2';
//        $student->save();
//        dd($student);

//        $num = Student::where('id','>',1006)->update([
//            'age'=>41,
//            'name'=>'jjjj',
//            'sex'=>30
//        ]);
//        var_dump($num);
        //使用模型删除数据
//        $student = Student::find(1006);
//        $bool = $student->delete();
//        echo $bool;
        //通过主键删除
//        $num = Student::destroy([1005,1004]);
//        echo $num;
    }
    public function index(){
        //表单分页
        $students = Student::where('id','>','1003')
        ->paginate(2);//参数为每页显示的个数

        return view('student.index',[
            'students'=>$students,
        ]);
    }
    public function creat(Request $request)
    {
        //控制器表单输入验证，如果错误抛出异常,保存到全局变量$errors中
        $this->validate($request,[
            'student.name' =>'required|min:2|max:20',
            'student.age' =>'required|integer',
            'student.sex' =>'required|integer',
        ],[
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'integer' => ':attribute 必须为整数',
        ],[
            'student.name' => '姓名',
            'student.age' => '年龄',
            'student.sex' => '性别',
    ]);
        //Validator类验证
        $validator = \validator::make($request->input(),[
            'student.name' =>'required|min:2|max:20',
            'student.age' =>'required|integer',
            'student.sex' =>'required|integer',
        ],[
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'integer' => ':attribute 必须为整数',
        ],[
            'student.name' => '姓名',
            'student.age' => '年龄',
            'student.sex' => '性别',
        ]);
        if ($validator->fails()){
            //withInput()数据保持
            //使用时直接在模板文件中的 value 值为{{old('Student')['name']}}即可
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    public function session1(Request $request)
    {
       //1.HTTP request session
//        $request->session()->put('name','jiajun');
//        echo $request->session()->get('name');
        //2.session()
//        session()->put('name','jiajun');
//        echo session()->get('name');
        //3.session类
//        Session::put('key3','jiajun');
//        echo Session::get('key3');
//        echo Session::get('key4','defult');
        //以数组形式存储数据
//        Session::put(['key3'=>'jiajun','key4'=>'jkjk']);
        //把数据放到Session的数组中
//        Session::push('student','heguo');
//        Session::push('student','jkjun');
        //取出数据并删除
//        $res =Session::pull('student','default');
        //取出所有数据
//        Session::all();
        //判断Session 是否存在
//        Session::has('key');
        //删除某个session值
//        Session::forget('key3');
        //清空所有Session信息
//        Session::flush();
        //Session信息闪存（只能访问一次）
//        Session::flash('flash1','flash');


    }

}