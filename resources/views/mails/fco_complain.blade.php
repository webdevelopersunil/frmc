<x-mail::message>

# Subject: Acknowledgment of Complaint Lodged – Complaint ID {{ $complain['complain_no'] }}

<p>Dear {{ $sendTo }},</p>
<p>This is to inform you that the status of your complaint (Complaint ID: {{$complain['complain_no']}}) has been updated.</p>
<p>To view the status and further details, please log in to our portal using the following link <a href="https://frmc.ongc.co.in/login">FRMC PORTAL</a></p>
<p>We value your involvement and assure you that the confidentiality of your identity will be maintained throughout the process.</p>

<h3>Complaint Details:</h3>
<ul>
    <li><strong>Complaint ID::</strong> {{ $complain['complain_no'] }}</li>
    <li><strong>Complainant Name:</strong> {{ $complainant_user['name'] }}</li>
    <li><strong>Address:</strong> {{ $complainant_user['name']  }}</li>
    <li><strong>Phone Number:</strong> {{ $complainant_user['phone'] }}</li>
    <li><strong>Email Address:</strong> {{ $complainant_user['email'] }}</li>
    <li><strong>Date of Complaint:</strong> {{ $complain['created_at'] }}</li>
</ul>

<p>Best regards,<strong> FCO</strong></p>
<p>Disclaimer:This is an automated message. Please do not reply to this email.</p>

</x-mail::message>