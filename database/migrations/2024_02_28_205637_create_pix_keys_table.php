<?php

use App\Models\CheckingAccount;
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
        Schema::create('pix_keys', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(CheckingAccount::class)->constrained();
            $table->enum('type', [1, 2, 3, 4]);
            $table->string('key', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pix_keys');
    }
};
