/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/views/front/**/*.blade.php",
		"./resources/**/*.blade.php",
	],
	theme: {
		extend: {
			colors: {
				primary: {
					100: "#FCF4FD",
					200: "#E2B2EB",
					950: "#780E8A"
				},
				secondary: {
					100: "#6acfc9",
					800: "#0E7975",
					950: "#22BDB7"
				},
				gray: {
					50: "#F0F2F2",
					100: "#D9D9D9",
					200: "#CFCFCF",
					300: "#949494",
					350: "#575757",
					400: "#606161",
					500: "#3C3D3D",
					600: "#150F29",
					800: "#222222"
				}
			},
			boxShadow: {
				btn1: "0px 4px 10px 0px #00000040",
				md: "0px 2px 10px 0px #0000001A"

			},
			fontFamily: {
				IRANSans: "IRANSans"
			}
		},
	},
	plugins: [],
}

