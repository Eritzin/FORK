function search(firstname)
{
	console.log(firstname);
	fetchSearchData(firstname);
	
	//to check if searchbox is empty
	empty = firstname;
}

function fetchSearchData(firstname)
{
	fetch('../../actions/jSearch.php',
	{
		method: 'POST',
		body: new URLSearchParams('firstname=' + firstname)
	})
	.then(res => res.json())
	.then(res => viewSearchResult(res))
	.catch(e => console.error('Error:' + e))
}

function viewSearchResult(data)
{	
	console.log("call");

	const searchResults = document.getElementById("searchResults");
	searchResults.innerHTML = "";

	for(let i = 0; i < data.length; i++)
	{
		const div = document.createElement("div");
		div.className = "alumni";
		div.innerHTML+= "<img style='width:50px;' src = '"+ data[i]["img"]+ "'>";
		div.innerHTML+= "<p>"+ data[i]["firstname"]+ "</p>";
		div.innerHTML+= "<p>"+ data[i]["lastname"]+ "</p>";
		div.innerHTML+= "<a target='_blank' href ='../alumni/alumniProfile.php?id="+data[i]["alumniId"]+"'>My Profile</a><br>";
	
		searchResults.appendChild(div);
	}

	//to not show search Results

	if(empty == "")
	{
		searchResults.innerHTML = "";	
	}

	if(data.length == 0)
	{
		searchResults.innerHTML = "No Results";
	}
}














