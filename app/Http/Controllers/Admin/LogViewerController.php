<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LogViewerController extends Controller
{
    public function index()
    {
        $logs = [];
        $logsPath = storage_path('logs');

        $foundDailyLogs = false;
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $logFile = "{$logsPath}/laravel-{$date}.log";

            if (file_exists($logFile)) {
                $content = file_get_contents($logFile);
                $entries = $this->parseLogFile($content);
                $logs = array_merge($logs, $entries);
                $foundDailyLogs = true;
            }
        }

        if (!$foundDailyLogs) {
            $singleLogFile = "{$logsPath}/laravel.log";
            if (file_exists($singleLogFile)) {
                $content = file_get_contents($singleLogFile);
                $entries = $this->parseLogFile($content);
                $logs = array_merge($logs, $entries);
            }
        }

        usort($logs, fn($a, $b) => strtotime($b['timestamp']) - strtotime($a['timestamp']));

        $perPage = 50;
        $page = request()->get('page', 1);
        $total = count($logs);
        $paginatedLogs = array_slice($logs, ($page - 1) * $perPage, $perPage);
        $lastPage = ceil($total / $perPage);

        return view('admin.logs.index', [
            'logs' => $paginatedLogs,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    private function parseLogFile(string $content): array
    {
        $logs = [];
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }


            if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]\s+(\w+)\.(\w+)\s*:\s*(.*)/', $line, $matches)) {
                $logs[] = [
                    'timestamp' => $matches[1],
                    'channel' => $matches[2],
                    'level' => $matches[3],
                    'message' => $matches[4],
                ];
            }
        }

        return $logs;
    }
}
