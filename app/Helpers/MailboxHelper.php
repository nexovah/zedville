<?php

namespace App\Helpers;

use Illuminate\Support\Facades\View;

class MailboxHelper
{
    /**
     * Render a mailbox template view as HTML string.
     *
     * @param string $templateName  (e.g., 'welcome')
     * @param array $data           (e.g., ['user' => $user])
     * @return string
     */
    public static function renderMailboxTemplate(string $templateName, array $data = []): string
    {
        $viewPath = "mailbox_templates.{$templateName}";

        if (!View::exists($viewPath)) {
            return "Template '{$templateName}' not found.";
        }

        return view($viewPath, $data)->render();
    }
}
