<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class ResumeFiles
{
    private bool $active = false;
    private array $created = [];
    private array $obsolete = [];

    public function transaction(callable $operation): mixed
    {
        if ($this->active) {
            return $operation();
        }

        $this->active = true;
        $this->created = $this->obsolete = [];

        try {
            $result = DB::transaction($operation);
        } catch (Throwable $exception) {
            foreach ($this->created as [$disk, $path]) {
                $this->remove($disk, $path);
            }
            $this->created = $this->obsolete = [];
            throw $exception;
        } finally {
            $this->active = false;
        }

        foreach ($this->obsolete as [$disk, $path]) {
            $this->remove($disk, $path);
        }

        $this->created = $this->obsolete = [];
        return $result;
    }

    public function store(UploadedFile $file, string $directory, string $disk = 'private'): string
    {
        $path = $file->store($directory, $disk);
        if (!$path) {
            throw new RuntimeException('Unable to store the uploaded file.');
        }
        if ($this->active) {
            $this->created[] = [$disk, $path];
        }
        return $path;
    }

    public function delete(?string $path, string $disk = 'private'): void
    {
        if (!$path) {
            return;
        }
        if ($this->active) {
            $this->obsolete[] = [$disk, $path];
        } else {
            $this->remove($disk, $path);
        }
    }

    private function remove(string $disk, string $path): void
    {
        try {
            if (!Storage::disk($disk)->delete($path)) {
                report(new RuntimeException('Unable to remove an obsolete resume file.'));
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
