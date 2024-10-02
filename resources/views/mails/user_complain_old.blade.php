<x-mail::message>


# FRMC Portal — Complaint Notification

<p>Dear {{ $recipient_email }},</p>
<p>Complainant {{ $user['name'] }} has successfully @if($action == "CREATED") created @else updated @endif the complaint in the FRMC Portal.</p>

<h3>Complaint Details:</h3>
<ul>
    <li><strong>Complaint Number:</strong> {{ $complain_no }}</li>
    <li><strong>Complainant Name:</strong> {{ $user['name'] }}</li>
    <li><strong>Email Address:</strong> {{ $user['email'] }}</li>
    <li><strong>Phone Number:</strong> {{ $user['phone'] }}</li>
</ul>

<!-- <p>We are reviewing your complaint and will keep you updated regarding its progress.</p> -->

Regards,{{ config('app.name') }}

</x-mail::message>