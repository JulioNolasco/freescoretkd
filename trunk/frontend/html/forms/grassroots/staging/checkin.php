<div class="pt-page pt-page-1 page-checkin">
	<div class="page-header">
		<div class="page-header-content">Athlete Check-in</div>
	</div>
	<div class="container" id="checkin-view">
	</div>
</div>
<script>
var update = {};
update.registration = { "athletes" : { "015126ec" : { "age" : "7", "belt" : "White Belt with Yellow Stripe", "first_name" : "Logan", "gender" : "Male", "last_name" : "CASHMAN", "name" : "Logan CASHMAN", "weight" : "0" }, "0859c275" : { "age" : "11", "belt" : "White Belt with Yellow Stripe", "first_name" : "Hrishi", "gender" : "Male", "last_name" : "VIJAY", "name" : "Hrishi VIJAY", "weight" : "0" }, "0f9d0a9f" : { "age" : "13", "belt" : "Red Belt with Black Stripe", "first_name" : "Ava", "gender" : "Female", "last_name" : "KWOK", "name" : "Ava KWOK", "weight" : "0" }, "110284e2" : { "age" : "10", "belt" : "White Belt", "first_name" : "Lucy", "gender" : "Female", "last_name" : "CAMP", "name" : "Lucy CAMP", "weight" : "0" }, "118aa208" : { "age" : "35", "belt" : "Green Belt", "first_name" : "Justin", "gender" : "Male", "last_name" : "BAUMLI", "name" : "Justin BAUMLI", "weight" : "76.4" }, "11edce0a" : { "age" : "13", "belt" : "Red Belt", "first_name" : "Saqif Ayaan", "gender" : "Male", "last_name" : "SUDHEER", "name" : "Saqif Ayaan SUDHEER", "weight" : "39.5" }, "1763813e" : { "age" : "6", "belt" : "White Belt with Yellow Stripe", "first_name" : "Kai", "gender" : "Male", "last_name" : "HUNG", "name" : "Kai HUNG", "weight" : "15.9" }, "1a64139a" : { "age" : "15", "belt" : "Green Belt with Black Stripe", "first_name" : "Sander", "gender" : "Male", "last_name" : "BOUCHARD", "name" : "Sander BOUCHARD", "weight" : "0" }, "1c69c73f" : { "age" : "9", "belt" : "Orange Belt with Black Stripe", "first_name" : "Sanya", "gender" : "Female", "last_name" : "CHOUDHARI", "name" : "Sanya CHOUDHARI", "weight" : "31.4" }, "1e1aa940" : { "age" : "13", "belt" : "Red Belt with Black Stripe", "first_name" : "Ittai", "gender" : "Male", "last_name" : "LUBITCH", "name" : "Ittai LUBITCH", "weight" : "41.4" }, "23659b16" : { "age" : "8", "belt" : "Yellow Belt with White Stripe", "first_name" : "Dhriti", "gender" : "Female", "last_name" : "DEEPAK", "name" : "Dhriti DEEPAK", "weight" : "20.5" }, "24caa2e0" : { "age" : "5", "belt" : "Yellow Belt with White Stripe", "first_name" : "Derek", "gender" : "Male", "last_name" : "ALTEKAR", "name" : "Derek ALTEKAR", "weight" : "0" }, "29c06fcb" : { "age" : "8", "belt" : "White Belt with Orange Stripe", "first_name" : "Saanvi", "gender" : "Female", "last_name" : "RATHOD", "name" : "Saanvi RATHOD", "weight" : "26" }, "2a711b51" : { "age" : "14", "belt" : "Red Belt with Black Stripe", "first_name" : "Sarvesh", "gender" : "Male", "last_name" : "AIYAGARI", "name" : "Sarvesh AIYAGARI", "weight" : "0" }, "2aa85fe8" : { "age" : "15", "belt" : "Brown Belt with Black Stripe", "first_name" : "Anand", "gender" : "Male", "last_name" : "ASHAR", "name" : "Anand ASHAR", "weight" : "48.6" }, "2b2b6ae6" : { "age" : "6", "belt" : "White Belt with Purple Stripe", "first_name" : "Jeffrey", "gender" : "Male", "last_name" : "LIM", "name" : "Jeffrey LIM", "weight" : "0" }, "32251dc5" : { "age" : "49", "belt" : "Red Belt", "first_name" : "Philip", "gender" : "Male", "last_name" : "WONG", "name" : "Philip WONG", "weight" : "70.5" }, "3388dfaa" : { "age" : "11", "belt" : "Red Belt", "first_name" : "Daniel", "gender" : "Male", "last_name" : "PEREZ", "name" : "Daniel PEREZ", "weight" : "44.1" }, "36c86420" : { "age" : "11", "belt" : "Red Belt", "first_name" : "Justin", "gender" : "Male", "last_name" : "HUNG", "name" : "Justin HUNG", "weight" : "24.1" }, "3a58a400" : { "age" : "36", "belt" : "Black Belt", "first_name" : "Juan", "gender" : "Male", "last_name" : "LANDIN", "name" : "Juan LANDIN", "weight" : "72.7" }, "3ef7d6f7" : { "age" : "9", "belt" : "White Belt with Yellow Stripe", "first_name" : "Reuben", "gender" : "Male", "last_name" : "KURZER", "name" : "Reuben KURZER", "weight" : "27.7" }, "4230d016" : { "age" : "14", "belt" : "Yellow Belt with Orange Stripe", "first_name" : "Griffin", "gender" : "Male", "last_name" : "BUI", "name" : "Griffin BUI", "weight" : "0" }, "43bcdbe7" : { "age" : "10", "belt" : "Purple Belt", "first_name" : "Rishay", "gender" : "Male", "last_name" : "RAM", "name" : "Rishay RAM", "weight" : "40.1" }, "4914d96e" : { "age" : "8", "belt" : "Yellow Belt with Orange Stripe", "first_name" : "Ilan", "gender" : "Male", "last_name" : "SALINAS", "name" : "Ilan SALINAS", "weight" : "0" }, "4ce9b897" : { "age" : "17", "belt" : "Red Belt with Black Stripe", "first_name" : "Parth", "gender" : "Male", "last_name" : "SHROTRI", "name" : "Parth SHROTRI", "weight" : "86.4" }, "50c1b33b" : { "age" : "9", "belt" : "Blue Belt with Black Stripe", "first_name" : "Leo", "gender" : "Male", "last_name" : "SILBERSTEIN", "name" : "Leo SILBERSTEIN", "weight" : "24.1" }, "56857636" : { "age" : "9", "belt" : "White Belt with Purple Stripe", "first_name" : "Sradha", "gender" : "Female", "last_name" : "PRADEEP", "name" : "Sradha PRADEEP", "weight" : "26.4" }, "58bdf1be" : { "age" : "10", "belt" : "Blue Belt", "first_name" : "Siyona", "gender" : "Female", "last_name" : "KHER", "name" : "Siyona KHER", "weight" : "0" }, "5a090dd3" : { "age" : "7", "belt" : "Green Belt", "first_name" : "Kirik", "gender" : "Male", "last_name" : "ALTEKAR", "name" : "Kirik ALTEKAR", "weight" : "0" }, "5d5b3438" : { "age" : "11", "belt" : "Red Belt with Black Stripe", "first_name" : "Kavinaya", "gender" : "Female", "last_name" : "SENTHILKUMAR", "name" : "Kavinaya SENTHILKUMAR", "weight" : "0" }, "629169d3" : { "age" : "7", "belt" : "White Belt with Blue Stripe", "first_name" : "Gayatri", "gender" : "Female", "last_name" : "UNNIKRISHNAN", "name" : "Gayatri UNNIKRISHNAN", "weight" : "0" }, "6317605a" : { "age" : "7", "belt" : "White Belt with Yellow Stripe", "first_name" : "Ryan", "gender" : "Male", "last_name" : "TRUONG", "name" : "Ryan TRUONG", "weight" : "0" }, "6370fdb3" : { "age" : "12", "belt" : "Yellow Belt with White Stripe", "first_name" : "Julian", "gender" : "Male", "last_name" : "CUDZINOVIC", "name" : "Julian CUDZINOVIC", "weight" : "50.9" }, "68440f3b" : { "age" : "16", "belt" : "Red Belt", "first_name" : "Steven", "gender" : "Male", "last_name" : "BHIRDO", "name" : "Steven BHIRDO", "weight" : "60.5" }, "695c978d" : { "age" : "11", "belt" : "Green Belt", "first_name" : "Jeremias", "gender" : "Male", "last_name" : "STAUCH", "name" : "Jeremias STAUCH", "weight" : "44.1" }, "6cc354f6" : { "age" : "16", "belt" : "Blue Belt", "first_name" : "Michelle", "gender" : "Female", "last_name" : "WALLERIUS", "name" : "Michelle WALLERIUS", "weight" : "0" }, "74745508" : { "age" : "9", "belt" : "Blue Belt", "first_name" : "Emily", "gender" : "Female", "last_name" : "KWOK", "name" : "Emily KWOK", "weight" : "0" }, "76d1e123" : { "age" : "11", "belt" : "Green Belt", "first_name" : "Allon", "gender" : "Male", "last_name" : "LUBITCH", "name" : "Allon LUBITCH", "weight" : "34.4" }, "7944f4b0" : { "age" : "9", "belt" : "Blue Belt with Black Stripe", "first_name" : "Laura", "gender" : "Female", "last_name" : "PEREZ", "name" : "Laura PEREZ", "weight" : "44.5" }, "79b72c71" : { "age" : "12", "belt" : "Red Belt with Black Stripe", "first_name" : "Maya", "gender" : "Female", "last_name" : "KRISHNAN", "name" : "Maya KRISHNAN", "weight" : "43.2" }, "7e445f8e" : { "age" : "6", "belt" : "White Belt with Green Stripe", "first_name" : "Oren", "gender" : "Male", "last_name" : "SALINAS", "name" : "Oren SALINAS", "weight" : "0" }, "7e69af7f" : { "age" : "7", "belt" : "White Belt", "first_name" : "Phoebe", "gender" : "Female", "last_name" : "CAMP", "name" : "Phoebe CAMP", "weight" : "0" }, "833492d0" : { "age" : "11", "belt" : "Brown Belt", "first_name" : "Skylar", "gender" : "Female", "last_name" : "YAU", "name" : "Skylar YAU", "weight" : "0" }, "83fccce1" : { "age" : "9", "belt" : "Brown Belt", "first_name" : "Pranay", "gender" : "Male", "last_name" : "BOKDE", "name" : "Pranay BOKDE", "weight" : "0" }, "87ed6a9d" : { "age" : "12", "belt" : "Red Belt", "first_name" : "Samantha", "gender" : "Female", "last_name" : "REGI", "name" : "Samantha REGI", "weight" : "48.2" }, "9a8b8e5f" : { "age" : "8", "belt" : "White Belt with Yellow Stripe", "first_name" : "Rannvijay", "gender" : "Male", "last_name" : "SINGH", "name" : "Rannvijay SINGH", "weight" : "0" }, "9af0f6ee" : { "age" : "7", "belt" : "Yellow Belt with White Stripe", "first_name" : "Diyaashree", "gender" : "Female", "last_name" : "SENTHILKUMAR", "name" : "Diyaashree SENTHILKUMAR", "weight" : "0" }, "9eb65729" : { "age" : "15", "belt" : "Brown Belt", "first_name" : "Serafin", "gender" : "Male", "last_name" : "STAUCH", "name" : "Serafin STAUCH", "weight" : "74.5" }, "a54530b3" : { "age" : "9", "belt" : "Green Belt with Black Stripe", "first_name" : "Rayna", "gender" : "Female", "last_name" : "AMBROSE", "name" : "Rayna AMBROSE", "weight" : "0" }, "a59943e4" : { "age" : "8", "belt" : "Yellow Belt with White Stripe", "first_name" : "Adam", "gender" : "Male", "last_name" : "LEVY-CHONG", "name" : "Adam LEVY-CHONG", "weight" : "19.1" }, "a966d00f" : { "age" : "17", "belt" : "Black Belt", "first_name" : "Sonaal", "gender" : "Male", "last_name" : "JAYAWARDENA", "name" : "Sonaal JAYAWARDENA", "weight" : "61.4" }, "ad137364" : { "age" : "12", "belt" : "Red Belt", "first_name" : "Krishna", "gender" : "Male", "last_name" : "ARVIND", "name" : "Krishna ARVIND", "weight" : "36.4" }, "aec179fc" : { "age" : "8", "belt" : "Yellow Belt with White Stripe", "first_name" : "Dylan", "gender" : "Male", "last_name" : "BERMAN", "name" : "Dylan BERMAN", "weight" : "30.5" }, "b09a7eb1" : { "age" : "9", "belt" : "Brown Belt", "first_name" : "Huancheng (Ronnie)", "gender" : "Male", "last_name" : "WANG", "name" : "Huancheng (Ronnie) WANG", "weight" : "22.3" }, "ba05a53d" : { "age" : "11", "belt" : "Red Belt with Black Stripe", "first_name" : "Suraj RAJESH", "gender" : "Male", "last_name" : "KUMAR", "name" : "Suraj RAJESH KUMAR", "weight" : "29.5" }, "bbdafab5" : { "age" : "9", "belt" : "Yellow Belt with White Stripe", "first_name" : "Kaira", "gender" : "Female", "last_name" : "PRADEEP", "name" : "Kaira PRADEEP", "weight" : "0" }, "bc520489" : { "age" : "6", "belt" : "White Belt with Yellow Stripe", "first_name" : "Victor", "gender" : "Male", "last_name" : "TORRES-BERNARD", "name" : "Victor TORRES-BERNARD", "weight" : "23.2" }, "bde4a383" : { "age" : "10", "belt" : "Purple Belt", "first_name" : "Benjamin", "gender" : "Male", "last_name" : "LECY-CHONG", "name" : "Benjamin LECY-CHONG", "weight" : "21.8" }, "bf902ba3" : { "age" : "12", "belt" : "Red Belt", "first_name" : "Aeden", "gender" : "Male", "last_name" : "BERMAN", "name" : "Aeden BERMAN", "weight" : "36.4" }, "c1d23649" : { "age" : "14", "belt" : "Red Belt with Black Stripe", "first_name" : "Max", "gender" : "Male", "last_name" : "WESTER", "name" : "Max WESTER", "weight" : "0" }, "c4248d5b" : { "age" : "10", "belt" : "Green Belt", "first_name" : "Matthew", "gender" : "Male", "last_name" : "LIM", "name" : "Matthew LIM", "weight" : "0" }, "c64dad57" : { "age" : "9", "belt" : "Yellow Belt with Orange Stripe", "first_name" : "Isla", "gender" : "Female", "last_name" : "BUI", "name" : "Isla BUI", "weight" : "0" }, "c67d97b8" : { "age" : "11", "belt" : "Blue Belt", "first_name" : "Kaashvi", "gender" : "Female", "last_name" : "MITTAL", "name" : "Kaashvi MITTAL", "weight" : "0" }, "c6ea7d1b" : { "age" : "7", "belt" : "White Belt", "first_name" : "Jordan", "gender" : "Male", "last_name" : "BENAVIDEZ", "name" : "Jordan BENAVIDEZ", "weight" : "21.8" }, "c99dcd75" : { "age" : "15", "belt" : "Black Belt", "first_name" : "Aiden", "gender" : "Male", "last_name" : "BEGOLE", "name" : "Aiden BEGOLE", "weight" : "60.7" }, "dad038e1" : { "age" : "11", "belt" : "Orange Belt", "first_name" : "Samuel", "gender" : "Male", "last_name" : "LI", "name" : "Samuel LI", "weight" : "49.1" }, "db172347" : { "age" : "9", "belt" : "Orange Belt", "first_name" : "Shreya", "gender" : "Female", "last_name" : "SUJIT", "name" : "Shreya SUJIT", "weight" : "21.8" }, "dc8ced43" : { "age" : "9", "belt" : "Purple Belt", "first_name" : "Anamika", "gender" : "Female", "last_name" : "TOMER", "name" : "Anamika TOMER", "weight" : "0" }, "de10aa94" : { "age" : "14", "belt" : "Black Belt", "first_name" : "Adarsh", "gender" : "Male", "last_name" : "GUPTA", "name" : "Adarsh GUPTA", "weight" : "65.9" }, "df6c7734" : { "age" : "12", "belt" : "Yellow Belt with Orange Stripe", "first_name" : "Kartik Raj", "gender" : "Male", "last_name" : "SARAVANAN", "name" : "Kartik Raj SARAVANAN", "weight" : "30.9" }, "dfafcfbd" : { "age" : "11", "belt" : "Black Belt", "first_name" : "Parth", "gender" : "Male", "last_name" : "DHAULAKHANDI", "name" : "Parth DHAULAKHANDI", "weight" : "36.4" }, "e0692d65" : { "age" : "6", "belt" : "Orange Belt", "first_name" : "Lena", "gender" : "Female", "last_name" : "SILBERSTEIN", "name" : "Lena SILBERSTEIN", "weight" : "20.5" }, "e9e36960" : { "age" : "6", "belt" : "White Belt with Yellow Stripe", "first_name" : "Ria", "gender" : "Female", "last_name" : "RAM", "name" : "Ria RAM", "weight" : "0" }, "f2d53328" : { "age" : "16", "belt" : "Brown Belt", "first_name" : "Kasiet", "gender" : "Female", "last_name" : "TEMIRALIEVA", "name" : "Kasiet TEMIRALIEVA", "weight" : "61.4" }, "f58ccfed" : { "age" : "16", "belt" : "Red Belt with Black Stripe", "first_name" : "Kanav", "gender" : "Male", "last_name" : "MITTAL", "name" : "Kanav MITTAL", "weight" : "56.8" }, "f6e2d04c" : { "age" : "7", "belt" : "White Belt with Yellow Stripe", "first_name" : "Ava", "gender" : "Female", "last_name" : "ESSON", "name" : "Ava ESSON", "weight" : "24.5" }, "f8662857" : { "age" : "11", "belt" : "Yellow Belt with Orange Stripe", "first_name" : "Sophie", "gender" : "Female", "last_name" : "BUI", "name" : "Sophie BUI", "weight" : "0" }, "f945266c" : { "age" : "9", "belt" : "Green Belt", "first_name" : "Anika", "gender" : "Female", "last_name" : "ATHALE", "name" : "Anika ATHALE", "weight" : "0" }, "fcb3b1ae" : { "age" : "14", "belt" : "Green Belt", "first_name" : "Annecy", "gender" : "Female", "last_name" : "BEGOLE", "name" : "Annecy BEGOLE", "weight" : "40.9" } }, "checkin" : { "kp01a" : { "2b2b6ae6" : false, "7e445f8e" : false, "e9e36960" : false }, "kp01b" : { "629169d3" : false, "f6e2d04c" : false }, "kp01c" : { "015126ec" : false, "6317605a" : false, "c6ea7d1b" : false }, "kp01d" : { "29c06fcb" : false, "9a8b8e5f" : false, "aec179fc" : false }, "kp01e" : { "3ef7d6f7" : false, "56857636" : false }, "kp01f" : { "0859c275" : false, "110284e2" : false }, "oc01a" : { "2b2b6ae6" : false, "bc520489" : false, "e0692d65" : false }, "oc01b" : { "1763813e" : false, "24caa2e0" : false, "7e445f8e" : false }, "oc02a" : { "7e69af7f" : false, "9af0f6ee" : false }, "oc02b" : { "015126ec" : false, "6317605a" : false, "c6ea7d1b" : false }, "oc03" : { "23659b16" : false, "4914d96e" : false, "a59943e4" : false }, "oc04" : { "1c69c73f" : false, "3ef7d6f7" : false, "56857636" : false, "bbdafab5" : false }, "oc05a" : { "110284e2" : false, "5d5b3438" : false, "f8662857" : false }, "oc05b" : { "36c86420" : false, "ba05a53d" : false, "bde4a383" : false, "c4248d5b" : false }, "pb01" : { "bbdafab5" : false, "f6e2d04c" : false }, "pb02a" : { "43bcdbe7" : false, "bde4a383" : false }, "pb02b" : { "695c978d" : false, "7944f4b0" : false, "dad038e1" : false }, "pb03a" : { "4ce9b897" : false, "9eb65729" : false, "de10aa94" : false }, "pb03b" : { "68440f3b" : false, "c99dcd75" : false, "f2d53328" : false }, "pb03c" : { "1e1aa940" : false, "3388dfaa" : false }, "pb03d" : { "ba05a53d" : false, "dfafcfbd" : false }, "pp01a" : { "23659b16" : false, "4914d96e" : false }, "pp01b" : { "1c69c73f" : false, "bbdafab5" : false }, "pp02a" : { "a54530b3" : false, "dc8ced43" : false }, "pp02b" : { "50c1b33b" : false, "bde4a383" : false }, "pp03a" : { "36c86420" : false, "5d5b3438" : false, "ba05a53d" : false }, "pp03b" : { "0f9d0a9f" : false, "11edce0a" : false, "ad137364" : false, "bf902ba3" : false, "c1d23649" : false }, "pp03c" : { "f2d53328" : false, "f58ccfed" : false }, "pp04" : { "32251dc5" : false }, "sb01a" : { "695c978d" : false, "76d1e123" : false }, "sb01b" : { "9eb65729" : false, "de10aa94" : false }, "sp01" : { "50c1b33b" : false, "695c978d" : false }, "sp02" : { "695c978d" : false, "87ed6a9d" : false }, "sp03" : { "9eb65729" : false, "de10aa94" : false }, "sp04" : { "a966d00f" : false, "de10aa94" : false }, "tp01a" : { "9af0f6ee" : false, "e0692d65" : false }, "tp01b" : { "4914d96e" : false, "a59943e4" : false, "aec179fc" : false }, "tp01c" : { "23659b16" : false, "bbdafab5" : false, "c64dad57" : false }, "tp01d" : { "1c69c73f" : false, "db172347" : false }, "tp01e" : { "dad038e1" : false, "f8662857" : false }, "tp01f" : { "4230d016" : false, "df6c7734" : false }, "tp02a" : { "5a090dd3" : false, "74745508" : false, "f945266c" : false }, "tp02b" : { "43bcdbe7" : false, "c4248d5b" : false }, "tp02c" : { "58bdf1be" : false, "c67d97b8" : false }, "tp02d" : { "1a64139a" : false, "6cc354f6" : false }, "tp03a" : { "83fccce1" : false, "b09a7eb1" : false }, "tp03b" : { "79b72c71" : false, "833492d0" : false, "87ed6a9d" : false }, "tp03c" : { "11edce0a" : false, "1e1aa940" : false, "36c86420" : false, "bf902ba3" : false }, "tp03d" : { "2a711b51" : false, "2aa85fe8" : false, "68440f3b" : false }, "tp04" : { "118aa208" : false }, "ws01a" : { "6370fdb3" : false, "fcb3b1ae" : false }, "ws01b" : { "3a58a400" : false, "c99dcd75" : false, "de10aa94" : false } }, "divisions" : { "kp01a" : { "description" : "6yo Beginner", "event" : "dc19a65e", "id" : "kp01a" }, "kp01b" : { "description" : "7yo Female Beginner", "event" : "dc19a65e", "id" : "kp01b" }, "kp01c" : { "description" : "7yo Male Beginner", "event" : "dc19a65e", "id" : "kp01c" }, "kp01d" : { "description" : "8yo Beginner", "event" : "dc19a65e", "id" : "kp01d" }, "kp01e" : { "description" : "9yo Beginner", "event" : "dc19a65e", "id" : "kp01e" }, "kp01f" : { "description" : "10-11 Beginner", "event" : "dc19a65e", "id" : "kp01f" }, "oc01a" : { "description" : "5-6 Beginner [Group A]", "event" : "b7aa4a12", "id" : "oc01a" }, "oc01b" : { "description" : "5-6 Beginner [Group B]", "event" : "b7aa4a12", "id" : "oc01b" }, "oc02a" : { "description" : "7yo Female Beginner", "event" : "b7aa4a12", "id" : "oc02a" }, "oc02b" : { "description" : "7yo Male Beginner", "event" : "b7aa4a12", "id" : "oc02b" }, "oc03" : { "description" : "8yo Beginner", "event" : "b7aa4a12", "id" : "oc03" }, "oc04" : { "description" : "9yo Beginner", "event" : "b7aa4a12", "id" : "oc04" }, "oc05a" : { "description" : "10-11 Female", "event" : "b7aa4a12", "id" : "oc05a" }, "oc05b" : { "description" : "10-11 Male", "event" : "b7aa4a12", "id" : "oc05b" }, "pb01" : { "description" : "Beginner", "event" : "ccdbd64f", "id" : "pb01" }, "pb02a" : { "description" : "Light Intermediate", "event" : "ccdbd64f", "id" : "pb02a" }, "pb02b" : { "description" : "Heavy Intermediate", "event" : "ccdbd64f", "id" : "pb02b" }, "pb03a" : { "description" : "Fin Advanced", "event" : "ccdbd64f", "id" : "pb03a" }, "pb03b" : { "description" : "Light Advanced", "event" : "ccdbd64f", "id" : "pb03b" }, "pb03c" : { "description" : "Middle Advanced", "event" : "ccdbd64f", "id" : "pb03c" }, "pb03d" : { "description" : "Heavy Advanced", "event" : "ccdbd64f", "id" : "pb03d" }, "pp01a" : { "description" : "8yo Beginner", "event" : "7b52936b", "id" : "pp01a" }, "pp01b" : { "description" : "9yo Beginner", "event" : "7b52936b", "id" : "pp01b" }, "pp02a" : { "description" : "9yo Female Intermediate", "event" : "7b52936b", "id" : "pp02a" }, "pp02b" : { "description" : "8-11 Male Intermediate", "event" : "7b52936b", "id" : "pp02b" }, "pp03a" : { "description" : "10-11 Advanced", "event" : "7b52936b", "id" : "pp03a" }, "pp03b" : { "description" : "12-14 Advanced", "event" : "7b52936b", "id" : "pp03b" }, "pp03c" : { "description" : "15-17 Advanced", "event" : "7b52936b", "id" : "pp03c" }, "pp04" : { "description" : "Under 50 Advanced", "event" : "7b52936b", "id" : "pp04" }, "sb01a" : { "description" : "Speed Breaking Intermediate", "event" : "e3b92e3e", "id" : "sb01a" }, "sb01b" : { "description" : "Speed Breaking Advanced", "event" : "e3b92e3e", "id" : "sb01b" }, "sp01" : { "description" : "8-11 Male Intermediate [Exhibition NHC]", "event" : "b6ccd47d", "id" : "sp01" }, "sp02" : { "description" : "10-14 Mixed Intermediate [Exhibition NHC]", "event" : "b6ccd47d", "id" : "sp02" }, "sp03" : { "description" : "12-17 Male Advanced [Exhibition JSR]", "event" : "b6ccd47d", "id" : "sp03" }, "sp04" : { "description" : "12-17 Male Black [Exhibition JSR]", "event" : "b6ccd47d", "id" : "sp04" }, "tp01a" : { "description" : "6-7 Female Beginner", "event" : "9a9fad90", "id" : "tp01a" }, "tp01b" : { "description" : "8-9 Male Beginner", "event" : "9a9fad90", "id" : "tp01b" }, "tp01c" : { "description" : "8-9 Female Beginner [Group C]", "event" : "9a9fad90", "id" : "tp01c" }, "tp01d" : { "description" : "8-9 Female Beginner [Group D]", "event" : "9a9fad90", "id" : "tp01d" }, "tp01e" : { "description" : "10-11 Beginner", "event" : "9a9fad90", "id" : "tp01e" }, "tp01f" : { "description" : "12-14 Beginner", "event" : "9a9fad90", "id" : "tp01f" }, "tp02a" : { "description" : "6-9 Intermediate", "event" : "9a9fad90", "id" : "tp02a" }, "tp02b" : { "description" : "10-11 Male Intermediate", "event" : "9a9fad90", "id" : "tp02b" }, "tp02c" : { "description" : "10-11 Female Intermediate", "event" : "9a9fad90", "id" : "tp02c" }, "tp02d" : { "description" : "15-17 Intermediate", "event" : "9a9fad90", "id" : "tp02d" }, "tp03a" : { "description" : "8-9 Male Advanced", "event" : "9a9fad90", "id" : "tp03a" }, "tp03b" : { "description" : "10-14 Female Advanced", "event" : "9a9fad90", "id" : "tp03b" }, "tp03c" : { "description" : "10-14 Male Advanced", "event" : "9a9fad90", "id" : "tp03c" }, "tp03d" : { "description" : "12-17 Male Advanced", "event" : "9a9fad90", "id" : "tp03d" }, "tp04" : { "description" : "Under 40 Intermediate", "event" : "9a9fad90", "id" : "tp04" }, "ws01a" : { "description" : "12-14 Weapons Beginner-Intermediate", "event" : "d321a3dd", "id" : "ws01a" }, "ws01b" : { "description" : "Under 40 Black", "event" : "d321a3dd", "id" : "ws01b" } }, "events" : { "7b52936b" : { "divisions" : [ "pp01b", "pp02b", "pp03a", "pp03b", "pp04", "pp01a", "pp02a", "pp03c" ], "method" : "single elimination", "name" : "Palgwe Traditional Forms", "start" : "10:00 AM" }, "9a9fad90" : { "divisions" : [ "tp02b", "tp01c", "tp03b", "tp01d", "tp01a", "tp01b", "tp03d", "tp02c", "tp03a", "tp01f", "tp01e", "tp04", "tp02a", "tp03c", "tp02d" ], "method" : "single elimination", "name" : "Taegeuk Traditional Forms", "start" : "11:00 AM" }, "b6ccd47d" : { "divisions" : [ "sp04", "sp01", "sp03", "sp02" ], "method" : "single elimination", "name" : "Sparring", "start" : "2:00 PM" }, "b7aa4a12" : { "divisions" : [ "oc02b", "oc05a", "oc01b", "oc03", "oc02a", "oc05b", "oc01a", "oc04" ], "method" : "cutoff", "name" : "Obstacle Course", "start" : "9:00 AM" }, "ccdbd64f" : { "divisions" : [ "pb03b", "pb01", "pb02a", "pb03c", "pb02b", "pb03a", "pb03d" ], "method" : "cutoff", "name" : "Power Breaking", "start" : "1:00 PM" }, "d321a3dd" : { "divisions" : [ "ws01a", "ws01b" ], "method" : "single elimination", "name" : "Weapons Sparring", "start" : "3:00 PM" }, "dc19a65e" : { "divisions" : [ "kp01f", "kp01b", "kp01e", "kp01c", "kp01d", "kp01a" ], "method" : "single elimination", "name" : "Kibon Basic Forms", "start" : "9:30 AM" }, "e3b92e3e" : { "divisions" : [ "sb01a", "sb01b" ], "method" : "cutoff", "name" : "Speed Breaking", "start" : "1:00 PM" } } };
var registration = undefined;

$(() => {
	refresh.checkin( update );
});

var refresh = {
	checkin: ( update ) => {
		registration = new Registration( update.registration );
		
	}
}

</script>
