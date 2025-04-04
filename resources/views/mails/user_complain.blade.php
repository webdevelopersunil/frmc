<x-mail::message>

# Subject: Acknowledgment of Complaint Lodged – Complaint ID {{ $complain['complain_no'] }}

<p>Dear {{ $sendTo }},</p>
<p>We acknowledge the receipt of your complaint lodged on $complain['created_at']. Below are the details of your complaint:</p>

<h3>Complaint Details:</h3>
<ul>
    <li><strong>Complaint ID::</strong> {{ $complain['complain_no'] }}</li>
    <li><strong>Complainant Name:</strong> {{ $complainant_user['name'] }}</li>
    <li><strong>Address:</strong> {{ $complainant_user['name']  }}</li>
    <li><strong>Phone Number:</strong> {{ $complainant_user['phone'] }}</li>
    <li><strong>Email Address:</strong> {{ $complainant_user['email'] }}</li>
    <li><strong>Date of Complaint:</strong> {{ $complain['created_at'] }}</li>
</ul>

<p>Your complaint has been forwarded to the concerned department for further investigation. We assure you that the matter will be handled with utmost priority.</p>
<p>You can check updates on your lodged complaint by visiting the following web link: https://frmc.ongc.co.in/login.</p>
<p>We assure you that the identity of the complainant will be kept confidential and necessary safeguards are in place to protect your personal information.</p>
<p>Should you have any further queries or require additional information, please feel free to contact the Nodal Officer.</p>

<h3>Nodal Officer Details:</h3>
<ul>
    <li><strong>Name:</strong> {{ $nodal['name'] }}</li>
    <li><strong>Mobile Number:</strong> {{ $nodal['phone'] }}</li>
    <li><strong>Email ID:</strong> {{ $nodal['email'] }}</li>
</ul>

<p>For your reference, we have attached a copy of ONGC's Fraud Policy in this email. We appreciate your vigilance and cooperation in helping us maintain ethical standards.</p>

<p>Best regards,<strong> FCO</strong></p>
<p>Disclaimer:This is an automated message. Please do not reply to this email.</p>

</x-mail::message>