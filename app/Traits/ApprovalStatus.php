<?php

namespace App\Traits;

use App\Events\ApprovalStatusChange;

trait ApprovalStatus
{
    public $default_number_field = 'id';

    public function getAutoNumber()
    {
        return $this->{$this->auto_number_field ?: $this->default_number_field};
    }

    public function scopeOfPending($query)
    {
        return $query->where(self::getTable() . '.approval_status', 0); // pending
    }

    public function scopeOfApproved($query)
    {
        return $query->where(self::getTable() . '.approval_status', 1); // approved
    }

    public function scopeOfRejected($query)
    {
        return $query->where(self::getTable() . '.approval_status', 2); // rejected
    }

    public function scopeOfCanceled($query)
    {
        return $query->where(self::getTable() . '.approval_status', 3); // rejected
    }

    public function scopeUnapprovedFirst($query)
    {
        return $query->orderBy(self::getTable() . '.approval_status', 'asc')->orderBy(self::getTable() . '.created_at', 'desc');
    }

    public function getApprovalStatus()
    {
        $result = $this->getApprovalAttributes($this->approval_status);

        return $this->getApprovalOutput($result);
    }

    public function getApprovalAttributes($approval_status = 0)
    {
        $status = config("constants.approval_status.icon-class.{$approval_status}", null);
        $color = config("constants.approval_status.color-class.{$approval_status}", null);
        $text = config("constants.approval_status.data.{$approval_status}", null);

        if ($approval_status == 1) {
            $status = 'fa fa-check';
            $color = 'success';
        } elseif ($approval_status == 2) {
            $status = 'fa fa-ban';
            $color = 'danger';
        } elseif ($approval_status == 3) {
            $status = 'fa fa-times';
            $color = 'info';
        }
        return ['status' => $status, 'color' => $color, 'text' => $text];
    }

    public function getApprovalOutput($result, $display = 'h4', $html = '', $title_suffix = '')
    {
        $title = !empty($title_suffix) ? $result['text'] . ': ' . $title_suffix : $result['text'];
        if ($display == 'h4') {
            return '<h4 class="no-margin text-' . $result['color'] . '"><i class="' . $result['status'] . ' text-' . $result['color'] . '" title="' . $title . '"></i> ' . $html . '</h4>';
        } else {
            return '<span class="label label-' . $result['color'] . '" title="' . $title . '"><i class="' . $result['status'] . ' text-' . $result['color'] . '"></i> ' . $html . '</span>';
        }
    }

    public function markApproved($object, $input)
    {
        $object->approval_status = $input['status']; // approved
        $object->approval_status_reason = $input['apporval_reason'] ? : null;
        $object->save();

        //event(new ApprovalStatusChange($object, 'approved'));
    }

    public function markRejected($object, $input)
    {
        $object->approval_status = $input['status']; // rejected
        $object->approval_status_reason = $input['apporval_reason'] ?: null;
        $object->save();

        // make rejected to archive state
        // $object->makeArchive();

        //event(new ApprovalStatusChange($object, 'rejected'));
    }

    public function markCancel($object, $input)
    {
        $object->approval_status = $input['status']; // cancel
        $object->approval_status_reason = $input['apporval_reason'] ?: null;
        $object->save();

        // make rejected to archive state
        // $object->makeArchive();

        //event(new ApprovalStatusChange($object, 'cancelled'));
    }

    public function isApproved()
    {
        return isset($this->approval_status) && $this->approval_status == 1 ?: false;
    }
}
