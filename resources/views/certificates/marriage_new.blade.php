<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Marriage Certificate</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
            size: A4 portrait;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative;
            background-color: #fff;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: 0;
            width: 60%;
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 4px;
            color: #000;
        }
        .subtitle {
            font-size: 18px;
            margin-bottom: 2px;
            color: #333;
        }
        .certificate-number {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }
        .main-content {
            margin-bottom: 10px;
        }
        .couple-names {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            color: #000;
        }
        .details {
            margin-bottom: 10px;
        }
        .detail-row {
            margin-bottom: 6px;
            display: flex;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
            color: #333;
            font-size: 14px;
        }
        .detail-value {
            flex: 1;
            color: #000;
            font-size: 14px;
        }
        .footer {
            margin-top: 15px;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }
        .signature-line {
            width: 150px;
            border-top: 1px solid #000;
            margin: 4px auto;
        }
        .signature-title {
            font-size: 14px;
            color: #333;
            margin: 2px 0;
        }
        .stamp {
            position: absolute;
            bottom: 50px;
            right: 50px;
            width: 70px;
            height: 70px;
            opacity: 0.8;
        }
        .border {
            border: 2px solid #000;
            padding: 8px;
            margin: 8px;
            position: relative;
        }
        .corner {
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid #000;
        }
        .top-left {
            top: -2px;
            left: -2px;
            border-right: none;
            border-bottom: none;
        }
        .top-right {
            top: -2px;
            right: -2px;
            border-left: none;
            border-bottom: none;
        }
        .bottom-left {
            bottom: -2px;
            left: -2px;
            border-right: none;
            border-top: none;
        }
        .bottom-right {
            bottom: -2px;
            right: -2px;
            border-left: none;
            border-top: none;
        }
    </style>
</head>
<body>
    <div class="border">
        <div class="corner top-left"></div>
        <div class="corner top-right"></div>
        <div class="corner bottom-left"></div>
        <div class="corner bottom-right"></div>
        
        <img src="{{ public_path('images/rwanda-emblem.png') }}" class="watermark" alt="Rwanda Emblem">
        
        <div class="content">
            <div class="header">
                <div class="title">REPUBLIC OF RWANDA</div>
                <div class="subtitle">MINISTRY OF LOCAL GOVERNMENT</div>
                <div class="subtitle">MARRIAGE CERTIFICATES</div>
                <div class="certificate-number">Certificate No: {{ $certificate->certificate_number }}</div>
            </div>
            
            <div class="main-content">
                <div class="couple-names">
                    This is to certify that the marriage between<br>
                    <span style="color: #000;">{{ $application->user->full_name }}</span> and <span style="color: #000;">{{ $application->spouse_name }}</span>
                </div>
                
                <div class="details">
                    <div class="detail-row">
                        <div class="detail-label">Date of Marriage:</div>
                        <div class="detail-value">{{ $application->marriage_date->format('d F Y') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Place of Marriage:</div>
                        <div class="detail-value">{{ $application->marriage_location }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Groom's Details:</div>
                        <div class="detail-value">
                            Name: {{ $application->user->full_name }}<br>
                            Date of Birth: {{ $application->user->dob->format('d F Y') }}<br>
                            Gender: {{ $application->user->gender }}<br>
                            Address: {{ $application->user->address }}
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Bride's Details:</div>
                        <div class="detail-value">
                            Name: {{ $application->spouse_name }}<br>
                            Date of Birth: {{ $application->spouse_dob->format('d F Y') }}<br>
                            Gender: {{ $application->spouse_gender }}<br>
                            Address: {{ $application->spouse_address }}
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Witness:</div>
                        <div class="detail-value">
                            Name: {{ $application->witness_name }}<br>
                            Contact: {{ $application->witness_contact }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <div>Issued on: {{ $certificate->issue_date->format('d F Y') }}</div>
                <div class="signature-line"></div>
                <div class="signature-title">Registrar of Marriages</div>
                <div class="signature-title">Ministry of Local Government</div>
                <div class="signature-title">Republic of Rwanda</div>
            </div>
        </div>
    </div>
</body>
</html>