<template>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet"  href="codescaptain.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
	</head>
	<body>
		<div class="search-box">
			<input type="text" class="search-txt" placeholder="Search">
			<a class="search-btn">
				<i class="fas fa-search"></i>
			</a>
		</div>
		
	
	
	</body>
	</html>
	</template>
	
	<script>
	import axios from 'axios';
	
	export default {
	  data() {
		return {
		  documentList: [],
		};
	  },
	  created() {
		this.getDocumentList();
	  },
	  methods: {
		async getDocumentList() {
		  try {
			const response = await axios.get('http://localhost:8080/getDocu');
			this.documentList = response.data;
		  } catch (error) {
			console.error('Error fetching documents:', error);
		  }
		},
		getStatusBadgeClass(status) {
		  const badgeClasses = {
			'pending': 'badge badge-danger',
			'checked': 'badge badge-warning',
			'under reviewed': 'badge badge-info',
			'approved': 'badge badge-success',
		  };
		  return badgeClasses[status] || 'badge badge-secondary';
		},
		viewDocument(document) {
		  // Implement logic to handle the view button click, e.g., show a modal or navigate to a new page
		  console.log('View button clicked for document:', document);
		},
	  },
	};
	</script>
	
	<style scoped>
	.custom-card {
	  background-color: #191c24 !important;
	  color: #e45e5e !important;
	}
	.search-box {
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  background: #353b48;
	  height: 60px;
	  border-radius: 50px;
	  padding: 10px;
	}
	
	.search-box:hover .search-txt {
	  width: 200px;
	  padding: 0 6px;
	}
	
	.search-box:hover .search-btn {
	  background: #fff;
	}
	
	.search-btn {
	  color: #e84118;
	  float: right;
	  width: 40px;
	  height: 40px;
	  border-radius: 50%;
	  background: #487eb0;
	  display: flex;
	  justify-content: center;
	  align-items: center;
	}
	
	.search-txt {
	  border: none;
	  outline: none;
	  background: none;
	  float: left;
	  padding: 0;
	  color: #fff;
	  font-size: 16px;
	  line-height: 40px;
	  width: 0;
	  transition: width 400ms;
	}
	</style>