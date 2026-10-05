<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class ProtectResumeFiles extends Command
{
    protected $signature = 'resumes:protect-files';
    protected $description = 'Move legacy resume uploads out of publicly accessible storage';

    public function handle(): int
    {
        $public = Storage::disk('public');
        $private = Storage::disk('private');
        $count = 0;
        foreach (['uploaded-resumes', 'certificate-files', 'resume-profile-photos'] as $directory) {
            foreach ($public->allFiles($directory) as $path) {
                $stream = $public->readStream($path);
                if ($stream === false) {
                    throw new RuntimeException('Unable to read legacy upload.');
                }
                try {
                    if ($private->exists($path)) {
                        if (hash_file('sha256', $public->path($path)) !== hash_file('sha256', $private->path($path))) {
                            throw new RuntimeException('Conflicting private upload; public file retained.');
                        }
                    } elseif (!$private->put($path, $stream)) {
                        throw new RuntimeException('Unable to copy legacy upload.');
                    }
                } finally {
                    fclose($stream);
                }
                if (hash_file('sha256', $public->path($path)) !== hash_file('sha256', $private->path($path))) {
                    throw new RuntimeException('Upload verification failed; public file retained.');
                }
                if (!$public->delete($path)) {
                    throw new RuntimeException('Unable to remove the public upload.');
                }
                $count++;
            }
        }
        $this->info("Protected {$count} files.");
        return self::SUCCESS;
    }
}
