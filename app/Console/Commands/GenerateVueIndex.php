<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateVueIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vue:index {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Index Vue File for Admin Dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $componentName = $this->argument('name');

            $content = <<<EOD
        <script setup lang="ts">
        import AdminLayout from "@/components/Layouts/AdminLayout.vue"
        defineLayout(AdminLayout)
        </script>

        <template>
            <Head title="{$componentName}s"/>
            <v-container class="mt-15">
                <h1 class="font-bold text-4xl text-primary mb-4 mt-20 sm:mt-0">{$componentName}s</h1>
                <{$componentName}sTable />
            </v-container>
        </template>
        EOD;

        $targetDirectory = resource_path("ts/components/Pages/Admin");

        $targetFile = "{$targetDirectory}/{$componentName}/Index{$componentName}s.vue";

        if (!file_exists($targetFile)) {
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }
            file_put_contents($targetFile, $content);
            $this->info("Created Vue component: {$componentName}/Index{$componentName}s.vue");
        } else {
            $this->error("Vue component {$componentName}/{$componentName}s.vue already exists.");
        }
    }
}
