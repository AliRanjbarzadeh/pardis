<!-- Table-based template for email notifications. -->
<!-- This is a 3-column and 5-row table to offer some space around the body. -->
<!-- Border options are a must if you want to render well in MS Outlook. -->
<table style="width: 100%; border-spacing: 0px; border: 0px; border-collapse: collapse; direction: rtl;">

	<!-- Top Row -->
	<!-- Adjust the height to fit your logo -->
	<tr id="logo" style="height: 150px;">

		<!-- Row 1 Column 1 -->
		<!-- Adjust background color as desired for your branding -->
		<td style="width: 15%; background-color: black; border: 0px; border-collapse: collapse;"></td>
		<!-- Row 1 Column 2 -->
		<!-- Adjust the source URL for your logo location and color as needed -->
		<td style="width: 70%; background-color: black; text-align: center; border: 0px; border-collapse: collapse;">
			<img src="{{ asset('assets/front/images/logo.png') }}" alt=""/>
		</td>
		<!-- Row 1 Column 3 -->
		<!-- Adjust background color as desired -->
		<td style="width: 15%; background-color: black; border: 0px; border-collapse: collapse;"></td>
	</tr>

	<!-- Second Row -->
	<!-- Message Header. -->
	<tr id="contentHeader">
		<!-- Row 2 Column 1 -->
		<!-- Adjust background color as desired -->
		<td style="width: 15%; background-color: black; border: 0px; border-collapse: collapse;"></td>
		<!-- Row 2 Column 2 -->
		<!-- Adjust background color as desired -->
		<!-- Swap out text as your company desires -->
		<td style="width: 70%; background-color: white; padding-top: 10px; padding-left: 10px; padding-right: 10px; border: 0px; border-collapse: collapse;">
			<h3 style="text-align: center; color: black;">@lang('admin/contact.words.form.response')</h3>
			<h4>@lang('admin/contact.words.form.subject', ['subject' => $contactForm->subject])</h4>
			<p>{{ $contactForm->content }}</p>
			<hr style="width: 70%; text-align: center;">
			<br/>
		</td>
		<!-- Row 2 Column 3 -->
		<!-- Adjust background color as desired -->
		<td style="width: 15%; background-color: black; border: 0px; border-collapse: collapse;"></td>
	</tr>

	<!-- Third Row -->
	<!-- Main body. -->
	<tr id="content">
		<!-- Row 3 Column 1 -->
		<!-- Adjust background color as desired -->
		<td style="width: 15%; background-color: lightgrey; border: 0px; border-collapse: collapse;"></td>
		<!-- Row 3 Column 2 -->
		<!-- Swap out your own message, shortcodes, and closing-->
		<!-- Adjust background color as desired -->
		<td style="width: 70%; background-color: white; padding: 10px; border: 0px; border-collapse: collapse;">
			<p>
				<strong>@lang('admin/contact.words.response')</strong><br/>
				{{ $contactForm->answer }}
			</p>
			<br/>
		</td>
		<!-- Row 3 Column 3 -->
		<!-- Adjust background color as desired -->
		<td style="width: 15%; background-color: lightgrey; border: 0px; border-collapse: collapse;"></td>
	</tr>
</table>