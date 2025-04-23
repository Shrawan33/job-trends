<style>
    .img_wraper img {
        border-radius: 0 !important;
    }
</style>
<table style="width:100%" cellspacing="0" cellpadding="0" style="font-family: Verdana, Geneva, sans-serif; font-size:14px">
    <tr>
        <td>
            <table style="width:100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding:0 20px; vertical-align:top
                        @if (isset($input->logo) && !empty($input->logo)) <div style="width: 120px; margin-right: 15px; margin-bottom: 20px; vertical-align: top">
                                {!! $input->logo !!}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px; vertical-align:top">
                        @if (isset($input))
                            @if (!empty($input->resume_summary))
                                <div>
                                    {{-- <h3 style="font-family: 'Helvetica', sans-serif; font-size:16px; font-weight: 700; color: #000; margin-top: 20px; margin-bottom:8px;">
                                        {{ trans('label.resume_summary') }}</h3> --}}
                                    <p style="font-family: 'Helvetica', sans-serif; font-size:16px; margin-bottom:10px; color: #000; margin-top: 0;">
                                        {!! $input->resume_summary !!}
                                    </p>
                                </div>
                            @endif
                            <div
                                style="flex: 0 0 100%;max-width: 100%;margin-bottom:0 !important;position: relative;width: 100%;">
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
