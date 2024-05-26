<?php

use App\Models\User;
use App\Models\MaritalStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_information', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('birth_date');
            $table->string('mother_full_name');
            $table->foreignIdFor(MaritalStatus::class);
            $table->decimal('monthly_income', 9, 2, false)->nullable();
            $table->boolean('is_politically_exposed_person');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
