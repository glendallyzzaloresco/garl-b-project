<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = $this->getActivityLogs();
        
        // Reverse to show most recent first
        $logs = array_reverse($logs);

        // Paginate (5 per page)
        $perPage = 5;
        $page = request('page', 1);
        $paginated = array_slice($logs, ($page - 1) * $perPage, $perPage);
        $total = count($logs);

        return view('activityLog', [
            'logs' => $paginated,
            'currentPage' => $page,
            'totalPages' => ceil($total / $perPage),
            'total' => $total,
            'perPage' => $perPage,
        ]);
    }

    private function getActivityLogs()
    {
        $logFile = storage_path('logs/laravel.log');
        $logs = [];

        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            $lines = explode("\n", $content);

            foreach ($lines as $line) {
                if (trim($line) === '') {
                    continue;
                }

                // Parse log line format: [2026-03-02 14:45:50] environment.LEVEL: message...
                // Handles both local and production environments
                if (preg_match('/\[([^\]]+)\]\s+[a-z]+\.([A-Z]+):\s+(.+)/', $line, $matches)) {
                    $timestamp = $matches[1];
                    $level = strtolower($matches[2]);
                    $message = trim($matches[3]);

                    // Only include INFO level logs
                    if ($level === 'info') {
                        $logs[] = [
                            'timestamp' => $timestamp,
                            'level' => $level,
                            'message' => $this->formatMessage($message),
                            'full_message' => $message,
                        ];
                    }
                }
            }
        }

        return $logs;
    }

    private function formatMessage($message)
    {
        // Extract key information from the message
        $short = substr($message, 0, 100);
        if (strlen($message) > 100) {
            $short .= '...';
        }
        return $short;
    }

    public function clear()
    {
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            file_put_contents($logFile, '');
            return redirect('/activity-log')->with('success', 'Activity log cleared successfully.');
        }
        return redirect('/activity-log');
    }

    public function refresh()
    {
        $logs = $this->getActivityLogs();
        
        // Reverse to show most recent first
        $logs = array_reverse($logs);

        // Paginate (5 per page)
        $perPage = 5;
        $page = request('page', 1);
        $paginated = array_slice($logs, ($page - 1) * $perPage, $perPage);
        $total = count($logs);

        return response()->json([
            'logs' => $paginated,
            'currentPage' => $page,
            'totalPages' => ceil($total / $perPage) ?: 1,
            'total' => $total,
            'perPage' => $perPage,
        ]);
    }
}
