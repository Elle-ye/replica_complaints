<?php

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Add temporary columns for the new foreign keys
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('complaint_type_id')->nullable();
            $table->unsignedBigInteger('complaint_sub_type_id')->nullable();
        });

        // Step 2: Convert existing string values to IDs
        $tickets = DB::table('new_tickets')->get();
        
        foreach ($tickets as $ticket) {
            // Find the category by its name
            $category = Category::where('categoryName', $ticket->complaintType)->first();
            
            // Find the sub-category by its name
            $subCategory = SubCategory::where('subCategoryName', $ticket->complaintSubType)->first();
            
            // Update the ticket with the found IDs
            DB::table('new_tickets')
                ->where('id', $ticket->id)
                ->update([
                    'complaint_type_id' => $category?->id,
                    'complaint_sub_type_id' => $subCategory?->id,
                ]);
        }

        // Step 3: Drop the old string columns
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->dropColumn(['complaintType', 'complaintSubType']);
        });

        // Step 4: Rename the new columns to the original names
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->renameColumn('complaint_type_id', 'complaintType');
            $table->renameColumn('complaint_sub_type_id', 'complaintSubType');
        });

        // Step 5: Make the columns required (no nulls) and add foreign keys
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('complaintType')->nullable(false)->change();
            $table->unsignedBigInteger('complaintSubType')->nullable(false)->change();
            
            // Add foreign key constraints
            $table->foreign('complaintType')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('complaintSubType')->references('id')->on('sub_categories')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        // Step 1: Drop foreign keys
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->dropForeign(['complaintType']);
            $table->dropForeign(['complaintSubType']);
        });

        // Step 2: Add back the old string columns
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->string('complaintType_temp')->nullable();
            $table->string('complaintSubType_temp')->nullable();
        });

        // Step 3: Convert IDs back to names (reverse operation)
        $tickets = DB::table('new_tickets')->get();
        
        foreach ($tickets as $ticket) {
            $category = Category::find($ticket->complaintType);
            $subCategory = SubCategory::find($ticket->complaintSubType);
            
            DB::table('new_tickets')
                ->where('id', $ticket->id)
                ->update([
                    'complaintType_temp' => $category?->categoryName,
                    'complaintSubType_temp' => $subCategory?->subCategoryName,
                ]);
        }

        // Step 4: Drop the ID columns and rename temp columns
        Schema::table('new_tickets', function (Blueprint $table) {
            $table->dropColumn(['complaintType', 'complaintSubType']);
            $table->renameColumn('complaintType_temp', 'complaintType');
            $table->renameColumn('complaintSubType_temp', 'complaintSubType');
        });
    }
};