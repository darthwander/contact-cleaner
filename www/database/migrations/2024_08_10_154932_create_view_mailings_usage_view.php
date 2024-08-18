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
        //criar uma view no banco de dados
        DB::statement("
            CREATE OR REPLACE VIEW mailings_usage_view AS (
                SELECT
                    date(m.created_at) as creation_date,
                    company_id,
                    c.name as company_name,
                    count(*) as counter,
                    json_agg(
                        json_build_object(
                            'description', m.description,
                            'status_load', CASE WHEN m.status_load = 0 THEN 'Não Iniciado'
                                            WHEN m.status_load = 1 THEN 'Em andamento'
                                            ELSE 'Concluído' END,
                            'status_wipe', CASE
                                            WHEN m.status_wipe = 0 THEN 'Não Iniciado'
                                            WHEN m.status_wipe = 1 THEN 'Em andamento' ELSE 'Concluído' END,
                            'setup', CASE WHEN m.setup = true THEN 'OK' ELSE 'NÃO CONFIGURADO' END,
                            'error', CASE WHEN m.error = 0 THEN 'Sem Erros' ELSE 'Com Erros' END,
                            'filename', m.filename
                        )
                    ) as mailings
                FROM mailings m
                JOIN companies c ON c.id = m.company_id
                GROUP BY creation_date, company_id, company_name
            );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS mailings_usage_view');
    }
};
