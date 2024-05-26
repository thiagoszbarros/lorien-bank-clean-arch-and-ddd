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
            $table->string('cellphone', 13);
            $table->date('birth_date');
            $table->string('mother_full_name');
            $table->foreignIdFor(MaritalStatus::class);
            $table->boolean('is_pep')->comment('is politicaly exposed person');
            $table->decimal('monthly_income', 9, 2, false)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
