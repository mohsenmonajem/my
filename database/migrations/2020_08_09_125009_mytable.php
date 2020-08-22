<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mytable extends Migration {
    /**
    * Run the migrations.
    *
    * @return void
    */

    public function up()
    {

        Schema::table('users', function($table)
        {
            $table->rememberToken();
        });

        Schema::table('messages', function($table)
        {

            $table->time('timeteacher');
            $table->date('dateteacher');
            $table->text('dateteacher');



        });

        Schema::create('lesson_room', function ( Blueprint $table )
        {
            $table->unsignedBigInteger( 'lesson_id' );
            $table->unsignedBigInteger( 'room_id' );
            $table->foreign( 'room_id' )->references( 'id' )->on( 'rooms' );
            $table->foreign( 'lesson_id' )->references( 'id' )->on( 'lessons' );

        });
        Schema::create( 'lesson_teacher', function ( Blueprint $table ) {
            $table->unsignedBigInteger('lesson_id' );
            $table->unsignedBigInteger('teacher_id' );
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });

        Schema::create('admin', function ( Blueprint $table )
        {
            $table->integer('password');

        });
        Schema::create('room_student', function ( Blueprint $table )
        {
            $table->unsignedBigInteger( 'student_id' );
            $table->unsignedBigInteger( 'room_id' );
            $table->foreign( 'room_id' )->references( 'id' )->on( 'rooms' );
            $table->foreign( 'student_id' )->references( 'id' )->on( 'students' );

        });

        Schema::create('rooms', function ( Blueprint $table )
        {
            $table->id();
            $table->string( 'address' );
            $table->integer( 'capacity' );
            $table->integer( 'cost' );
            $table->date('startdate');
            $table->date('enddate');

        });

        Schema::create('room_teacher', function ( Blueprint $table )
        {
            $table->unsignedBigInteger( 'teacher_id' );
            $table->unsignedBigInteger( 'room_id' );
            $table->foreign( 'room_id' )->references( 'id' )->on( 'rooms' );
            $table->foreign( 'teacher_id' )->references( 'id' )->on( 'teachers' );

        });
        Schema::create( 'teachers', function ( Blueprint $table ) {

            $table->id();
            $table->unsignedBigInteger('user_id' );
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create( 'students', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger('user_id' );
            $table->foreign('user_id')->references('id')->on('users');

        });
        Schema::create( 'lessons', function ( Blueprint $table ) {

            $table->id();
            $table->string( 'namedars' );
            $table->string( 'payenumber' );
        });

        Schema::create( 'classes', function ( Blueprint $table )
        {
            $table->id();
            $table->unsignedBigInteger( 'teacher_id' );
            $table->unsignedBigInteger( 'lesson_id' );
            $table->foreign( 'teacher_id' )->references( 'id' )->on( 'teachers' );
            $table->foreign( 'lesson_id' )->references( 'id' )->on( 'lessons' );
            $table->string( 'address' );
            $table->integer( 'capacity' );
            $table->integer( 'cost' );
            $table->date('startdate');
            $table->date('enddate');
        });
        Schema::create( 'class_student', function ( Blueprint $table )
        {
            $table->unsignedBigInteger( 'student_id' );
            $table->unsignedBigInteger( 'class_id' );
            $table->foreign( 'student_id' )->references( 'id' )->on( 'students' );
            $table->foreign( 'class_id' )->references( 'id' )->on( 'classes' );
            $table->boolean('paymoney')->nullable()->default(false);
            $table->date('sabtenam');


        });

        Schema::create('messages', function ( Blueprint $table )
        {
            $table->unsignedBigInteger( 'teacher_id' );
            $table->unsignedBigInteger( 'student_id' );
            $table->foreign( 'teacher_id' )->references( 'id' )->on( 'teachers' );
            $table->foreign( 'student_id' )->references( 'id' )->on( 'students' );
            $table->string('messagestudent');
            $table->id();
            $table->string('replyteacher')->nullable();
            $table->date('datestudent');
            $table->date('dateteacher');
            $table->time('timestudent');
            $table->time('timeteacher');
            $table->boolean('studentread')->nullable()->default(false);
            $table->unsignedBigInteger('lesson_id');
            $table->foreign( 'lesson_id' )->references( 'id' )->on( 'lessons' );
            $table->boolean('teacherread')->nullable()->default(false);

        });


       Schema::table('users', function($table)
       {
         $table->binary('image');



       });



    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */

    public function down() {
        schema::drop('lessson_teacher');
    }
}
