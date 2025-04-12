<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Marriage Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .certificate {
            border: 2px solid #000;
            padding: 20px;
            margin: 0 auto;
            max-width: 800px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .content {
            margin-bottom: 30px;
        }
        .content p {
            margin: 10px 0;
        }
        .signatures {
            margin-top: 50px;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 50px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #666;
        }
        .certificate-number {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="certificate-number">
            Certificate No: {{ $certificateNumber }}
        </div>

        <div class="header">
            <h1>MARRIAGE CERTIFICATE</h1>
            <p>This is to certify that the following persons have been legally married</p>
        </div>

        <div class="content">
            <p><strong>Groom's Name:</strong> {{ $application->user->full_name }}</p>
            <p><strong>Groom's Date of Birth:</strong> {{ $application->user->dob->format('d M Y') }}</p>
            <p><strong>Groom's Address:</strong> {{ $application->user->address }}</p>

            <p><strong>Bride's Name:</strong> {{ $application->spouse_name }}</p>
            <p><strong>Bride's Date of Birth:</strong> {{ $application->spouse_dob->format('d M Y') }}</p>
            <p><strong>Bride's Address:</strong> {{ $application->spouse_address }}</p>

            <p><strong>Date of Marriage:</strong> {{ $application->marriage_date->format('d M Y') }}</p>
            <p><strong>Place of Marriage:</strong> {{ $application->marriage_location }}</p>

            <p><strong>Witness:</strong> {{ $application->witness_name }}</p>
        </div>

        <div class="signatures">
            <div style="float: left; margin-right: 50px;">
                <div class="signature-line"></div>
                <p>Registrar's Signature</p>
            </div>
            <div style="float: right;">
                <div class="signature-line"></div>
                <p>Date</p>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="footer">
            <p>This is a computer-generated certificate and does not require a physical signature.</p>
            <p>For verification, please visit our website or contact the marriage registration office.</p>
        </div>
    </div>
</body>
</html> 