<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BEMS Admin</title>
	<link href="{{ asset('css/admin.css') }}?v={{ time() }}" rel="stylesheet">
</head>
<body>
	<div class="bems-root">
		<div class="bems-admin-container box">
			<img src="{{ asset('img/biam.png')}}" class="admin-logo">
			<div class="header">
				<p class="bn" style="font-size: 20px;"> বিয়াম কর্মকর্তা/কর্মচারী বাতায়ন</p>
				<p class="bn"> প্রশাসন শাখা</p> 
			</div>
			<div class="menu bn">
				<ul>
					<li><a href="{{route('user_list')}}">&#9728; ইউজার তালিকা</a></li>
					<li><a href="{{route('add')}}">&#10010; নতুন সংযুক্তি</a></li>
					<li><a href="">&#10271; সম্পাদনা</a></li>
					<li><a href="{{route('logout')}}">&#10148; লগআউট</a></li>
				</ul>
			</div>
			<div class="content">
				@if($tab_no == 2)
				<div class="create-users">
					<p class="bn" style="font-weight: bold;"> &#9960; মৌলিক তথ্য: </p>
					<hr style="outline: 0">
					<form id="userForm" method="POST" action="/" class="bn" enctype="multipart/form-data">
						<P class="bn" style="margin: 5px; color: green; font-weight: bold;">আপানার ইউনিক আইডি নম্বর: </P>
						<input type="text" name="dre" class="ins" readonly>
						<input class="ins bn" type="text" placeholder="আপনার পূর্ণনাম (যথা. মোঃ তুহিন মিয়া)" name="full_name" required>
						<input class="ins bn" type="text" placeholder="পদবি" name="designation" required>
						<label class="bn" style="margin: 5px; color: green; font-weight: bold;">বেতন স্কেল/গ্রেডঃ</label>
						<select name="grade" id="category" class="ins bn">
							<option value="2">গ্রেড-০২ (৬৬,০০০-৭৬,৪৯০/-)</option>
							<option value="3">গ্রেড-০৩ (৫৬,৫০০-৭৪,৪০০/-)</option>
							<option value="4">গ্রেড-০৪ (৫০,০০০-৭১,২০০/-)</option>
							<option value="5">গ্রেড-০৫ (৪৩,০০০-৬৯,৮৫০/-)</option>
							<option value="6">গ্রেড-০৬ (৩৫,৫০০-৬৭,০১০/-)</option>
							<option value="7">গ্রেড-০৭ (২৯,০০০-৬৩,৪১০/-)</option>
							<option value="8">গ্রেড-০৮ (২৩,০০০-৫৫,৪৬০/-)</option>
							<option value="9">গ্রেড-০৯ (২২,০০০-৫৩,০৬০/-)</option>
							<option value="10">গ্রেড-১০ (১৬,০০০-৩৮,৬৪০/-)</option>
							<option value="11">গ্রেড-১১ (১২,৫০০-৩২,২৪০/-)</option>
							<option value="12">গ্রেড-১২ (১১,৩০০-২৭,৩০০/-)</option>
							<option value="13">গ্রেড-১৩ (১১,০০০-২৬,৫৯০/-)</option>
							<option value="14">গ্রেড-১৪ (১০,২০০-২৪,৬৮০/-)</option>
							<option value="15">গ্রেড-১৫ (৯,৭০০-২৩,৪৯০/-)</option>
							<option value="16">গ্রেড-১৬ (৯,৩০০-২২,৪৯০/-)</option>
							<option value="17">গ্রেড-১৭ (৯,০০০-২১,৮০০/-)</option>
							<option value="18">গ্রেড-১৮ (৮,৮০০-২১,৩১০/-)</option>
							<option value="19">গ্রেড-১৯ (৮,৫০০-২০,৫৭০/-)</option>
							<option value="20">গ্রেড-২০ (৮,২৫০-২০,০১০/-)</option>
						</select>

						<label class="bn" style="margin: 5px; color: green; font-weight: bold;">চাকুরিতে যোগদানের তারিখঃ</label>
						<input type="date" name="joining_date" class="ins">
						<input type="text" name="nid" class="ins bn" placeholder="জাতীয় পরিচয়পত্র নম্বর">
						<input type="text" name="phone" class="ins bn" placeholder="ফোন নম্বর">
						<input type="text" name="last_degree" class="ins bn" placeholder="সর্বশেষ অর্জিত ডিগ্রী">
						<label class="bn" style="margin: 5px; color: green; font-weight: bold;">ছবি</label> 
						<input type="file" name="photo" required>
						<br><br>
						
						<p class="bn" style="font-weight: bold;"> &#9960; অন্যান্য তথ্য: </p>
						<button type="button" id="addRowButton" class="button bn">+ নুতন তথ্য সংযুক্তি</button>
						<div id="otherInfoContainer">
							<div class="key-value-row">
								<input type="text" name="other_info[0][key]" class="ins bn" placeholder="শিরোনাম">
								<input type="text" name="other_info[0][value]" class="ins bn" placeholder="বিবরণ">
								<button type="button" class="remove-row button bn">&#9866; মুছুন </button>
							</div>
						</div>
						<br><br>
						
						<button type="button" id="insertDataButton" class="bn">Insert Data</button>
						<button type="submit" id="submitBtn" class="bn" style="display:none;">Submit</button>
					</form>

					<p class="bn" style="font-weight: bold;"> &#9960; প্রদত্ত অন্যান্য তথ্য: </p>
					<div id="dynamicDataDisplay" class="bn"></div>
				</div>
				@endif
			</div>
		</div>
	</div>

	<script>
		// Add new input row for "other_info"
		document.getElementById('addRowButton').addEventListener('click', function() {
			var newRow = document.createElement('div');
			newRow.classList.add('key-value-row');
			newRow.innerHTML = `
				<input type="text" name="other_info[][key]" class="ins bn" style="display: inline" placeholder="ফিল্ড নাম">
				<input type="text" name="other_info[][value]" class="ins bn" style="display: inline" placeholder="মান">
				<button type="button" class="remove-row bn">মুছুন </button>
			`;
			document.getElementById('otherInfoContainer').appendChild(newRow);
		});
		
		// Remove input row for "other_info"
		document.getElementById('otherInfoContainer').addEventListener('click', function(event) {
			if (event.target && event.target.classList.contains('remove-row')) {
				event.target.parentElement.remove();
			}
		});
		
		// Insert data button - Show data immediately without submitting
		document.getElementById('insertDataButton').addEventListener('click', function() {
			// Get form data
			var form = document.getElementById('userForm');
			var formData = new FormData(form);
			var userData = '';

			// Loop through the form data and prepare the display string
			formData.forEach((value, key) => {
				if (key !== 'photo') { // Ignore photo field for display
					userData += `<strong>${key}:</strong> ${value}<br>`;
				}
			});

			// Display the inserted data
			document.getElementById('dynamicDataDisplay').innerHTML = userData;

			// Show the submit button
			document.getElementById('submitBtn').style.display = 'inline-block';
		});

		// Handle form submission (normal form submission)
		document.querySelector('#userForm').addEventListener('submit', function(event) {
			// Form will be submitted normally here
			alert('Form submitted!');
		});
	</script>
</body>
</html>
