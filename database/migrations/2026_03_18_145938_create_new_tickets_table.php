<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticketID')->unique();
            $table->date('date');
            $table->enum('ticketStatus',['New','Pending','Resolved','Rejected'])->default('New');
            $table->string('staffEmail');
            $table->string('acctNum');
            $table->string('cardNum');
            $table->string('custName');
            $table->string('ageRange');
            $table->string('custEmail')->nullable();
            $table->string('contactNum');
            $table->string('channel');
          
              //  origin - stores both dept and branch
            $table->unsignedBigInteger('origin_id');
            $table->enum('origin_type', ['department', 'branch']);

            //  destination - stores both dept and branch
            $table->unsignedBigInteger('destination_id');
            $table->enum('destination_type', ['department', 'branch']);

            $table->text('complaintSubject');
            $table->string('complaintType');
            $table->string('complaintSubType');
            $table->text('complaintDescription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_tickets');
    }
};
