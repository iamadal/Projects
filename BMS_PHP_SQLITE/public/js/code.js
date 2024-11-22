 $(document).ready(function() {
        var priceList = [
            { label: "    পরোট(২ পিস): ৪০ টাকা",        	value: "a1", sellingPrice: 40, actualPrice: 24 },
		    { label: "ডিম ভাজি(পোচ): ২৫ টাকা",         	value: "a2", sellingPrice: 25, actualPrice: 20 },
		    { label: "ডিমের কোরমা: ৪০ টাকা",              	value: "a3", sellingPrice: 40, actualPrice: 40 },
		    { label: "মিনিকেট চালের ভাত: ৩০ টাকা",     	value: "a4", sellingPrice: 30, actualPrice: 20 },
		    { label: "কাটারি চালের ভাত:  ৩৫ টাকা",       	value: "a5", sellingPrice: 35, actualPrice: 30 },
		    { label: "মুগ ডাল:  ৩০ টাকা",                       	value: "a6", sellingPrice: 30, actualPrice: 23 },
		    { label: "মশুর ডাল:  ২০ টাকা",                    	value: "a7", sellingPrice: 20, actualPrice: 15 },
		    { label: "মিক্সড সবজি:  ৩৫ টাকা", 				value: "a8", sellingPrice: 35, actualPrice: 30 },
		    { label: "চাইনিজ সবজি:  ৫৫ টাকা", 				value: "a9", sellingPrice: 55, actualPrice: 45 },
		    { label: "মিক্সড সালাদ:  ২৫ টাকা", 				value: "a10", sellingPrice: 25, actualPrice: 20 },
		    { label: "শশা(২ পিস):  ১০ টাকা", 					value: "a11", sellingPrice: 10, actualPrice: 6 },
		    { label: "মিক্সড ফ্রুট সালাদ:  ১১০ টাকা", 		value: "a12", sellingPrice: 110, actualPrice: 80 },
		    { label: "চিকেন নাট সালাদ:  ১০০ টাকা", 		value: "a13", sellingPrice: 100, actualPrice: 90 },
		    { label: "ফ্রুট কাস্টার্ড সালাদ:  ১৪০ টাকা", 		value: "a14", sellingPrice: 140, actualPrice: 120 },
		    { label: "বেগুনভাজি(২ পিস):  ৩০ টাকা", 		value: "a15", sellingPrice: 30, actualPrice: 24 },
		    { label: "মুরগীর রেজালা(১/৪):  ১৫০ টাকা",   value: "aa15", sellingPrice: 150, actualPrice: 110 },
		    { label: "মুরগীর রোস্ট(১/৪):  ১৭০ টাকা", 		 			value: "a16", sellingPrice: 170, actualPrice:130  },
		    { label: "রুই/কাতলা মাছের দোঁপেয়াজু:  ১৪০ টাকা",	 value: "a17", sellingPrice: 140, actualPrice: 105 },
		    { label: "রুপচাঁদা ফ্রাই:  ৪০০ টাকা", 							value: "a18", sellingPrice: 400, actualPrice: 300 },
		    { label: "ইলিশ ফ্রাই:  ৩০০ টাকা", 								value: "a19", sellingPrice: 300, actualPrice: 270 },
		    { label: "আইড় মাছ:  ২৬০ টাকা", 								value: "a20", sellingPrice: 260, actualPrice: 260 },
		    { label: "কাজলি/বাতাসি মাছ:  ২৩০ টাকা", 					value: "a21", sellingPrice: 230, actualPrice: 230 },
		    { label: "মলা মাছের চড়চড়ি:  ১২০ টাকা", 					value: "a22", sellingPrice: 120, actualPrice: 120 },
		    { label: "চিংড়ি কারি(৩ পিস)(১৮-২০ পিস/কেজি):  ৩০০ টাকা",	 value: "a23", sellingPrice: 300, actualPrice: 180 },
		    { label: "মাটন রেজালা(১/৫): ৩৫০ টাকা", 				value: "a24", sellingPrice: 350, actualPrice: 310 },
		    { label: "মাটন রেজালা(১/৪): ৪৫০ টাকা", 				value: "a25", sellingPrice: 450, actualPrice: 400 },
		    { label: "গরুর ভুনা(১/৫): ৩০০ টাকা", 						value: "a26", sellingPrice: 300, actualPrice: 260 },
		    { label: "গরুর ভুনা(১/৪): ৪০০ টাকা", 						value: "a27", sellingPrice: 400, actualPrice: 340 },
		    { label: "পোলাও: ১১০ টাকা", 									value: "a28", sellingPrice: 110, actualPrice: 95 },
		    { label: "মুগ ডালের খিচুড়ি(আচার সহ): ৯০ টাকা", value: "a29", sellingPrice: 90, actualPrice: 80 },
		    { label: "ফ্রাইড রাইছ: ১১০ টাকা",							 value: "a30", sellingPrice: 110, actualPrice: 90 },
		    { label: "কাচ্চি বিরিয়ানি(ফুল মাংশ-৩পিস): ৬০০ টাকা", 			value: "a31", sellingPrice: 600, actualPrice: 550 },
		    { label: "কাচ্চি বিরিয়ানি(ফুল মাংশ-৩পিস+ডিম ১ পিস): ৬২০ টাকা", 	value: "a32", sellingPrice: 620, actualPrice: 570 },
		    { label: "কাচ্চি বিরিয়ানি(হাফ মাংশ-২পিস+ডিম ১ পিস+আলু ১ পিস): ৪৭০ টাকা", value: "a33", sellingPrice: 470, actualPrice: 420 },
		    { label: "মোরগ পোলাও(মুরগী-১পিস+ ডিম-১পিস) ৩২০ টাকা",		value: "a34", sellingPrice: 320, actualPrice: 300 },
		    { label: "মাটন তেহারি: ৪০০ টাকা", 						value: "a35", sellingPrice: 400, actualPrice: 385 },
		    { label: "মাটন কাবাব: ৫৫ টাকা", value: "a36", sellingPrice: 55, actualPrice: 47 },
		    { label: "বিফ কাবাব: ৫০ টাকা", 	value: "a37", sellingPrice: 50, actualPrice: 47 },
		    { label: "চিকেন কাবাব: ৪৫ টাকা", 	value: "a38", sellingPrice: 45, actualPrice: 38 },
		    { label: "হালিম(মাটন): ৩০০ টাকা",  value: "a39", sellingPrice: 300, actualPrice: 265 },
		    { label: "হালিম(বিফ): ২৮০ টাকা", 	value: "a40", sellingPrice: 280, actualPrice: 240 },
		    { label: "চিকেন হালিম(সোনালী মুরগী): ১৮০ টাকা", 	value: "a41", sellingPrice: 180, actualPrice: 160 },
		    { label: "চিকেন ফ্রাই(সোনালী মুরগী ১/৪): ১৮০ টাকা",	value: "a42", sellingPrice: 180, actualPrice: 135 },
		    { label: "চিকেন ফ্রাই(ব্রয়লার ১/৪): ১৪০ টাকা", 		value: "a43", sellingPrice: 140, actualPrice: 115 },
		    { label: "চিকেন ফ্রাই((ব্রয়লার ১/৮): ৮০ টাকা", 		value: "a44", sellingPrice: 80, actualPrice: 60 },
		    { label: "চিকেন সাসলিক: ১৩০ টাকা", 	value: "a45", sellingPrice: 130, actualPrice: 125 },
		    { label: "চিকেন হরিয়ানা কাবাব: ১০০ টাকা", value: "a46", sellingPrice: 100, actualPrice: 90 },
		    { label: "পাউরুটি: ১০০ টাকা", 	value: "a48", sellingPrice: 100, actualPrice: 90 },
		    { label: "চিকেন বার্গার: ৭০ টাকা", value: "a49", sellingPrice: 70, actualPrice: 54 },
		    { label: "চিকেন বন: ৫০ টাকা", 	value: "a50", sellingPrice: 50, actualPrice: 40 },
		    { label: "চিকেন স্যান্ডউইচ: ৫৫ টাকা", value: "a51", sellingPrice: 55, actualPrice: 44 },
		    { label: "ক্লাব স্যান্ডউইচ: ১৫০ টাকা", value: "a52", sellingPrice: 150, actualPrice: 120 },
		    { label: "ভেজিটেবল রোল: ৪০ টাকা", 	value: "a53", sellingPrice: 40, actualPrice: 30 },
		    { label: "ভেজিটেবল পাকোড়া: ৩০ টাকা", value: "a54", sellingPrice: 30, actualPrice: 24 },
		    { label: "ফ্রুট কেক: ৪৫ টাকা",	value: "a55", sellingPrice: 45, actualPrice: 35 },
		    { label: "নরমাল কেক: ২৫ টাকা", value: "a56", sellingPrice: 25, actualPrice: 20 },
			{ label: "চিকেন পেটিশ : ৫৫ টাকা", value: "a57", sellingPrice: 55, actualPrice: 40 },
		    { label: "ভেজিটেবল পেটিশ: ৪৫ টাকা", value: "a58", sellingPrice: 45, actualPrice: 35 },
		    { label: "চিকেন সমুচা: ৩৫ টাকা", value: "a59", sellingPrice: 35, actualPrice: 30 },
		    { label: "ভেজিটেবল সমুচা: ৩০ টাকা",	 value: "a60", sellingPrice: 30, actualPrice: 25 },
		    { label: "আলু বাদামের সিঙ্গাড়া: ১৫ টাকা", value: "a61", sellingPrice: 15, actualPrice: 12 },
		    { label: "ভেজিটেবল সিঙ্গাড়া: ১৫ টাকা", value: "a62", sellingPrice: 15, actualPrice: 12 },
		    { label: "কলিজা সিঙ্গাড়া: ৪০ টাকা", value: "a63", sellingPrice: 40, actualPrice: 34 },
		    { label: "ছোলা: ২০ টাকা", value: "a65", sellingPrice: 20, actualPrice: 15 },
		    { label: "মুড়ি: ১০ টাকা",	value: "a66", sellingPrice: 10, actualPrice: 5 },
		    { label: "পেঁয়াজু(ছোট ২ পিস): ২০ টাকা", value: "a67", sellingPrice: 20, actualPrice: 16 },
		    { label: "বেগুনি ১ পিস: ১৭ টাকা", value: "a68", sellingPrice: 17, actualPrice: 14 },
		    { label: "আলুর চপ: ১৭ টাকা", 	value: "a69", sellingPrice: 17, actualPrice: 13 },
		    { label: "ডিমের চপ: ২৫ টাকা", value: "a70", sellingPrice: 25, actualPrice: 22 },
		    { label: "ডোনাট: ৩০ টাকা", value: "a71", sellingPrice: 30, actualPrice: 24 },
		    { label: "ড্যানিস: ৩০ টাকা", value: "a72", sellingPrice: 30, actualPrice: 24 },
		    { label: "চিকেন পিজা: ৮০ টাকা", value: "a73", sellingPrice: 80, actualPrice: 58 },
		    { label: "ফেঞ্চ টোস্ট: ৬০ টাকা", value: "a74", sellingPrice: 60, actualPrice: 44 },
		    { label: "মাটন লক: ১০০ টাকা", value: "a75", sellingPrice: 100, actualPrice: 70 },
		    { label: "চিকেন কাটলেট: ৫০ টাকা", value: "a76", sellingPrice: 50, actualPrice: 40 },
		    { label: "ফিস কাটলেট: ৬০ টাকা",  value: "a77", sellingPrice: 60, actualPrice: 40 },
		    { label: "ফিস ফিঙ্গার(২ পিস): ৬০ টাকা", value: "a78", sellingPrice: 60, actualPrice: 48 },
		    { label: "চিকেন বল(সিপি): ৬০ টাকা", value: "a79", sellingPrice: 60, actualPrice: 48 },
		    { label: "হটডগ: ৬০ টাকা", value: "a80", sellingPrice: 60, actualPrice: 50 },
		    { label: "খেজুর(নরমাল ২ পিস): ২৫ টাকা", value: "a81", sellingPrice: 25, actualPrice: 20 },
		    { label: "খেজুর(মরিয়ম ২ পিস): ৪০ টাকা", value: "a82", sellingPrice: 40, actualPrice: 34 },
		    { label: "পাঁকা আম: ৬৫ টাকা", 	value: "a83", sellingPrice: 65, actualPrice: 55 },
		    { label: "আনারস: ২৫ টাকা", value: "a84", sellingPrice: 25, actualPrice: 20 },
		    { label: "আঙ্গুর(সবুজ): ৬০ টাকা", 	value: "a85", sellingPrice: 60, actualPrice: 40 },
		    { label: "আঙ্গুর(লাল): ৭০ টাকা", value: "a86", sellingPrice: 70, actualPrice: 60 },
		    { label: "মাল্টা ১ পিস: ৭৫ টাকা", value: "a87", sellingPrice: 75, actualPrice: 70 },
		    { label: "মাল্টা (১/২) পিস: ৪০ টাকা", value: "a88", sellingPrice: 40, actualPrice: 35 },
		    { label: "আপেল(লাল): ৫৫ টাকা", value: "a89", sellingPrice: 55, actualPrice: 47 },
		    { label: "আপেল(সবুজ): ৬০ টাকা", value: "a90", sellingPrice: 60, actualPrice: 50 },
		    { label: "নাসপাতি ১টি: ৯০ টাকা", value: "a91", sellingPrice: 90, actualPrice: 80 },
		    { label: "নাসপাতি (১/২) টি: ৪৫ টাকা", value: "a92", sellingPrice: 45, actualPrice: 40 },
		    { label: "নাসপাতি (১/৪) টি: ২৫ টাকা", value: "a93", sellingPrice: 25, actualPrice: 20 },
		    { label: "আনার/বেদানা/ডালিম: ৮০ টাকা", 	value: "a94", sellingPrice: 80, actualPrice: 70 },
		    { label: "পাঁকা পেঁপে: ৪০ টাকা", value: "a95", sellingPrice: 40, actualPrice: 30 },
		    { label: "কমলা: ৫৫ টাকা", 	value: "a96", sellingPrice: 55, actualPrice: 47 },
		    { label: "ছবেদা: ২৫ টাকা",		value: "a97", sellingPrice: 25, actualPrice: 20 },
		    { label: "তরমুজ: ৩৫ টাকা", 	value: "a98", sellingPrice: 35, actualPrice: 30 },
		    { label: "বাংগি: ৩০ টাকা", 	value: "a99", sellingPrice: 30, actualPrice: 25 },
		    { label: "ড্রাগনফল: ১২০ টাকা", value: "a100", sellingPrice: 120, actualPrice: 90 },
		    { label: "পিয়ার্স(নাগফল): ৬০ টাকা", value: "a101", sellingPrice: 60, actualPrice: 50 },
		    { label: "কলা: ১৫ টাকা", 	value: "a102", sellingPrice: 15, actualPrice: 12 },
		    { label: "আপেল কুল(২ পিস): ২০ টাকা", value: "a103", sellingPrice: 20, actualPrice: 20 },
		    { label: "নারিকেল কুল(২ পিস): ৩৫ টাকা",	 value: "a104", sellingPrice: 35, actualPrice: 35 },
		    { label: "পেয়ারা(৩ ফালি): ২০ টাকা", value: "a105", sellingPrice: 20, actualPrice: 15 },
		    { label: "জিলাপি: ২৫ টাকা", value: "a106", sellingPrice: 25, actualPrice: 15 },
		    { label: "রেশমী জিলাপি: ৩০ টাকা", value: "a107", sellingPrice: 30, actualPrice: 20 },
		    { label: "ছানা সন্দেশ: ৬০ টাকা", value: "a108", sellingPrice: 60, actualPrice: 54 },
		    { label: "রসমালাই: ১০০ টাকা", 	value: "a109", sellingPrice: 100, actualPrice: 80 },
		    { label: "ফিরনী: ৫০ টাকা", value: "a110", sellingPrice: 50, actualPrice: 42 },
		    { label: "দই: ৫০ টাকা", value: "a111", sellingPrice: 50, actualPrice: 40 },
		    { label: "শাহি জর্দা: ৮০ টাকা", value: "a112", sellingPrice: 80, actualPrice: 70 },
		    { label: "চমচম: ৫০ টাকা", value: "a113", sellingPrice: 50, actualPrice: 42 },
		    { label: "ছানার আমৃতি: ১১০ টাকা", value: "a114", sellingPrice: 110, actualPrice: 100 },
		    { label: "বুরিন্দা: ৩০ টাকা", value: "a115", sellingPrice: 30, actualPrice:25  },
		    { label: "পুডিং: ১০০ টাকা", value: "a116", sellingPrice: 100, actualPrice: 75 },
		    { label: "সেমাই: ৫৫ টাকা", value: "a117", sellingPrice: 55, actualPrice: 50  },
		    { label: "দুধের পায়েস: ১০০ টাকা", value: "a118", sellingPrice: 100, actualPrice: 70 },
		    { label: "লেবুর শরবত: ২০ টাকা", value: "a119", sellingPrice: 20, actualPrice: 17 },
		    { label: "বাঙ্গির শরবত: ৩০ টাকা", 	value: "a120", sellingPrice: 30, actualPrice: 22 },
		    { label: "তরমুজের জুস: ৫০ টাকা", value: "a121", sellingPrice: 50, actualPrice: 40 },
		    { label: "বেলের শরবত: ৮০ টাকা", value: "a122", sellingPrice: 80, actualPrice: 55 },
		    { label: "পেঁপের শরবত: ৬০ টাকা", value: "a123", sellingPrice: 60, actualPrice: 60 },
		    { label: "ফালুদা: ১৫০ টাকা", 	value: "a124", sellingPrice: 150, actualPrice: 135 },
		    { label: "লাচ্ছি: ১০০ টাকা", 	value: "a125", sellingPrice: 100, actualPrice: 70 },
		    { label: "বোরহানি: ৫৫ টাকা", 	value: "a126", sellingPrice: 55, actualPrice: 44 },
		    { label: "আলু বোখারার চাটনি: ৪০ টাকা", value: "a127", sellingPrice: 40, actualPrice: 40 },
		    { label: "বরই/আমের আচার: ২০  টাকা", value: "a128", sellingPrice: 20, actualPrice: 20 },
		    { label: "আরসি/কোক/স্প্রাইট ক্যান: ৬৫ টাকা", value: "a129", sellingPrice: 65, actualPrice: 30 },
		    { label: "স্প্রাইট/ফান্টা(প্রতি গ্লাস) :  ৩৫ টাকা", 	value: "a130", sellingPrice: 35, actualPrice: 30 },
		    { label: "আরসি/পেপসি/কোক পেট বোতল: ৩৫ টাকা", 	value: "a131", sellingPrice: 35, actualPrice: 30 },
		    { label: "প্রাণ/সেজান জুস: ৩৫ টাকা", 			value: "a132", sellingPrice: 35, actualPrice: 30 },
		    { label: "কফি: ৩০ টাকা", 	value: "a133", sellingPrice: 30, actualPrice: 20 },
		    { label: "দুধ চা: ১৫ টাকা", value: "a134", sellingPrice: 15, actualPrice: 13 },
		    { label: "পানি ২৫০ মিলি. : ১০ টাকা",value: "a135", sellingPrice: 10, actualPrice: 7 },
		    { label: "পানি ৫০০ মিলি. : ১৫ টাকা", value: "a136", sellingPrice: 15, actualPrice: 10 },
		    { label: "পানি ২ লি. : ৩৫ টাকা", value: "a137", sellingPrice: 35, actualPrice: 21 },

		    //  Pacakge
		     { label: "প্যাকেজ-০১. : 130 টাকা", value: "a140", sellingPrice: 130, actualPrice: 0 },
		     { label: "প্যাকেজ-০২. : 280 টাকা", value: "a141", sellingPrice: 280, actualPrice: 0 },
		     { label: "প্যাকেজ-০৩. : 315 টাকা", value: "a142", sellingPrice: 315, actualPrice: 0 },
		     { label: "প্যাকেজ-০৪. : 410 টাকা", value: "a143", sellingPrice: 410, actualPrice: 0 },
		     { label: "প্যাকেজ-০৫. : 455 টাকা", value: "a144", sellingPrice: 455, actualPrice: 0 },
		     { label: "প্যাকেজ-০৬. : 655 টাকা", value: "a145", sellingPrice: 655, actualPrice: 21 },
		     { label: "প্যাকেজ-০৭. : 615 টাকা", value: "a146", sellingPrice: 615, actualPrice: 21 },
		     { label: "প্যাকেজ-০৮. : 795 টাকা", value: "a147", sellingPrice: 795, actualPrice: 21 },
		     { label: "প্যাকেজ-০৯. : 850 টাকা", value: "a148", sellingPrice: 850, actualPrice: 21 },
		     { label: "প্যাকেজ-১০. : 590 টাকা", value: "a149", sellingPrice: 590, actualPrice: 21 },
		     { label: "প্যাকেজ-১১. : 760 টাকা", value: "a150", sellingPrice: 760, actualPrice: 21 },
		     { label: "প্যাকেজ-১২. : 975 টাকা", value: "a151", sellingPrice: 975, actualPrice: 21 },
		     { label: "প্যাকেজ-১৩. : 740 টাকা", value: "a152", sellingPrice: 740, actualPrice: 21 },
		     { label: "প্যাকেজ-১৪. : 650 টাকা", value: "a153", sellingPrice: 650, actualPrice: 21 },
           
            // Unofficial Items
			{ label: "কাজুবাদাম : ৭০ টাকা", value: "a138", sellingPrice: 70, actualPrice: 70 },		

			// ভর্তা
			{ label: "কলা ভর্তা : 20 টাকা", value: "a139", sellingPrice: 20, actualPrice: 20 },	

			// 																				
        ];

          $("#removeBtn").click(function() {
        if (selectedItems.length > 0) {
            selectedItems.pop(); 
            updateSelectedItemsList(); 
        }
    });

        var selectedItems = [];

 		 function convertToBengaliNumerals(num) {
        const bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return num.toString().split('').map(digit => bengaliDigits[parseInt(digit)]).join('');
    }


    priceList.forEach(item => {
        item.label = item.label.replace(/(\d+)/g, (match) => convertToBengaliNumerals(match));
    });
    

        $("#item").autocomplete({
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(priceList, request.term);
                response(results.slice(0, 5)); 
            },
            select: function(event, ui) {
                addSelectedItem(ui.item);
                $("#item").val(''); 
                return false; 
            },
            focus: function(event, ui) {
             
                event.preventDefault();
            },
            minLength: 0 
        }).focus(function() {
            $(this).autocomplete("search", "");
        });


        $("#clearBtn").click(function() {
            selectedItems = [];
            updateSelectedItemsList();

        });


        function addSelectedItem(item) {
            selectedItems.push(item);
            updateSelectedItemsList();
        }

        function updateSelectedItemsList() {
            var selectedItemsContainer = $("#selectedItems");
            selectedItemsContainer.empty();

              var sellingTotal = 0;
  			  var actualTotal = 0;
    		  var vat = 0;
    		  var grandTotal = 0;

            for (var i = 0; i < selectedItems.length; i++) {
                var item = selectedItems[i];
                var itemHtml = '<div class="selected-item">' +
                                   '<span>' + item.label + '</span>' +
                               '</div>';
                selectedItemsContainer.append(itemHtml);
                sellingTotal += item.sellingPrice;
                actualTotal += item.actualPrice;
                vat = sellingTotal*0.05;
                grandTotal = sellingTotal+vat*2;
            }

            // Update total prices
            $("#sellingTotal").text(sellingTotal.toFixed(2));
            $("#vat").text(vat.toFixed(2));
            $("#service").text(vat.toFixed(2));
            $("#grandTotal").text(grandTotal.toFixed(2));
            $("#actualTotal").text(actualTotal.toFixed(2));
        }
    });