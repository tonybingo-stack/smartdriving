<?php

namespace App\Http\Controllers\Admin;

use OwenIt\Auditing\Models\Audit;

class AuditController extends TemplateController
{
    public function __construct(Audit $audit)
    {
        parent::__construct($audit, 'Admin/Audit/IndexAudits', '');
    }
}
