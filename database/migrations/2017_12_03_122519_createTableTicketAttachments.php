<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTicketAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')
                ->references('id')->on('employees');
            $table->string('mime_type')->default('application/octet-stream');
            $table->string('file_name');
            $table->binary('data');
            $table->integer('size');
            $table->integer('uploaded_at');
            $table->timestamps();
        });

        $table_name = DB::getTablePrefix();
        $table_name .= 'ticket_attachments';

        DB::statement("ALTER TABLE `{$table_name}` MODIFY `data` LONGBLOB;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_attachments');
    }
}
