<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateVueTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vue:table {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Table Vue File for Admin Dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $componentName = $this->argument('name');
        $lowercaseComponentName = strtolower($componentName);

            $content = <<<EOD
            <script setup lang="ts">
            import * as Yup from "yup"
            import dayjs from "dayjs"
            import AdminLayout from "@/components/Layouts/AdminLayout.vue"
            defineLayout(AdminLayout)
            
            const headers = ref([
                { title: "ID", key: "id", align: "end" },
                { title: "Actions", key: "actions", align: "center", sortable: false },
            ])
            
            const fields = ref([
            ])

            </script>
            
            <template>
                <DataServerSide
                    :headers="headers"
                    :fields="fields"
                    table="{$lowercaseComponentName}s"
                    api="api.{$lowercaseComponentName}s"
                    singular="{$componentName}">
                </DataServerSide>
            </template>
        EOD;

        $targetDirectory = resource_path("ts/components/Pages/Admin");

        $targetFile = "{$targetDirectory}/{$componentName}/{$componentName}sTable.vue";

        if (!file_exists($targetFile)) {
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }
            file_put_contents($targetFile, $content);
            $this->info("Created Vue component: {$componentName}/{$componentName}sTable.vue");
        } else {
            $this->error("Vue component {$componentName}/{$componentName}sTable.vue already exists.");
        }
    }
}
