curl -X GET "localhost:8080/album"

curl -X POST "localhost:8080/album" -H 'Content-Type: application/json' -d'
{
  "Artist_Id": 3057,
  "Title": "end"
}
'

curl -X POST "localhost:8080/album/5164" -H 'Content-Type: application/json' -d'
{
  "Album_Id": 5164,
  "Artist_Id": 3057,
  "Title": "end"
}
'

curl -X GET "localhost:8080/album/5164"

curl -X DELETE "localhost:8080/album/5164"

# --

curl -X GET "localhost:8080/artist"

curl -X POST "localhost:8080/artist" -H 'Content-Type: application/json' -d'
{
  "Name": "kid"
}
'

curl -X POST "localhost:8080/artist/9837" -H 'Content-Type: application/json' -d'
{
  "Artist_Id": 9837,
  "Name": "kid"
}
'

curl -X GET "localhost:8080/artist/9837"

curl -X DELETE "localhost:8080/artist/9837"

# --

curl -X GET "localhost:8080/customer"

curl -X POST "localhost:8080/customer" -H 'Content-Type: application/json' -d'
{
  "Address": "company",
  "City": "brother",
  "Company": "second",
  "Country": "speak",
  "Email": "Most carry meeting mean have.",
  "Fax": "time",
  "First_Name": "pressure",
  "Last_Name": "imagine",
  "Phone": "eat",
  "Postal_Code": "size",
  "State": "physical",
  "Support_Rep_Id": 9689
}
'

curl -X POST "localhost:8080/customer/1734" -H 'Content-Type: application/json' -d'
{
  "Address": "company",
  "City": "brother",
  "Company": "second",
  "Country": "speak",
  "Customer_Id": 1734,
  "Email": "Most carry meeting mean have.",
  "Fax": "time",
  "First_Name": "pressure",
  "Last_Name": "imagine",
  "Phone": "eat",
  "Postal_Code": "size",
  "State": "physical",
  "Support_Rep_Id": 9689
}
'

curl -X GET "localhost:8080/customer/1734"

curl -X DELETE "localhost:8080/customer/1734"

# --

curl -X GET "localhost:8080/employee"

curl -X POST "localhost:8080/employee" -H 'Content-Type: application/json' -d'
{
  "Address": "son",
  "Birth_Date": "2021-10-13 19:49:50",
  "City": "well",
  "Country": "accept",
  "Email": "Spring without former recent product turn road white.",
  "Fax": "let",
  "First_Name": "effort",
  "Hire_Date": "2021-09-21 20:23:07",
  "Last_Name": "blood",
  "Phone": "force",
  "Postal_Code": "result",
  "Reports_To": 1502,
  "State": "thousand",
  "Title": "modern"
}
'

curl -X POST "localhost:8080/employee/2639" -H 'Content-Type: application/json' -d'
{
  "Address": "son",
  "Birth_Date": "2021-10-13 19:49:50",
  "City": "well",
  "Country": "accept",
  "Email": "Spring without former recent product turn road white.",
  "Employee_Id": 2639,
  "Fax": "let",
  "First_Name": "effort",
  "Hire_Date": "2021-09-21 20:23:07",
  "Last_Name": "blood",
  "Phone": "force",
  "Postal_Code": "result",
  "Reports_To": 1502,
  "State": "thousand",
  "Title": "modern"
}
'

curl -X GET "localhost:8080/employee/2639"

curl -X DELETE "localhost:8080/employee/2639"

# --

curl -X GET "localhost:8080/genre"

curl -X POST "localhost:8080/genre" -H 'Content-Type: application/json' -d'
{
  "Name": "couple"
}
'

curl -X POST "localhost:8080/genre/5718" -H 'Content-Type: application/json' -d'
{
  "Genre_Id": 5718,
  "Name": "couple"
}
'

curl -X GET "localhost:8080/genre/5718"

curl -X DELETE "localhost:8080/genre/5718"

# --

curl -X GET "localhost:8080/invoice"

curl -X POST "localhost:8080/invoice" -H 'Content-Type: application/json' -d'
{
  "Billing_Address": "mention",
  "Billing_City": "fall",
  "Billing_Country": "accept",
  "Billing_Postal_Code": "party",
  "Billing_State": "sometimes",
  "Customer_Id": 8740,
  "Invoice_Date": "2021-09-25 22:32:44",
  "Total": 500.66
}
'

curl -X POST "localhost:8080/invoice/6170" -H 'Content-Type: application/json' -d'
{
  "Billing_Address": "mention",
  "Billing_City": "fall",
  "Billing_Country": "accept",
  "Billing_Postal_Code": "party",
  "Billing_State": "sometimes",
  "Customer_Id": 8740,
  "Invoice_Date": "2021-09-25 22:32:44",
  "Invoice_Id": 6170,
  "Total": 500.66
}
'

curl -X GET "localhost:8080/invoice/6170"

curl -X DELETE "localhost:8080/invoice/6170"

# --

curl -X GET "localhost:8080/invoiceline"

curl -X POST "localhost:8080/invoiceline" -H 'Content-Type: application/json' -d'
{
  "Invoice_Id": 3144,
  "Quantity": 5636,
  "Track_Id": 6223,
  "Unit_Price": 940.5
}
'

curl -X POST "localhost:8080/invoiceline/7029" -H 'Content-Type: application/json' -d'
{
  "Invoice_Id": 3144,
  "Invoice_Line_Id": 7029,
  "Quantity": 5636,
  "Track_Id": 6223,
  "Unit_Price": 940.5
}
'

curl -X GET "localhost:8080/invoiceline/7029"

curl -X DELETE "localhost:8080/invoiceline/7029"

# --

curl -X GET "localhost:8080/mediatype"

curl -X POST "localhost:8080/mediatype" -H 'Content-Type: application/json' -d'
{
  "Name": "natural"
}
'

curl -X POST "localhost:8080/mediatype/9428" -H 'Content-Type: application/json' -d'
{
  "Media_Type_Id": 9428,
  "Name": "natural"
}
'

curl -X GET "localhost:8080/mediatype/9428"

curl -X DELETE "localhost:8080/mediatype/9428"

# --

curl -X GET "localhost:8080/playlist"

curl -X POST "localhost:8080/playlist" -H 'Content-Type: application/json' -d'
{
  "Name": "statement"
}
'

curl -X POST "localhost:8080/playlist/7006" -H 'Content-Type: application/json' -d'
{
  "Name": "statement",
  "Playlist_Id": 7006
}
'

curl -X GET "localhost:8080/playlist/7006"

curl -X DELETE "localhost:8080/playlist/7006"

# --

curl -X GET "localhost:8080/playlisttrack"

curl -X POST "localhost:8080/playlisttrack" -H 'Content-Type: application/json' -d'
{
  "Playlist_Id": 1963,
  "Track_Id": 5865
}
'

curl -X POST "localhost:8080/playlisttrack/1951" -H 'Content-Type: application/json' -d'
{
  "Playlist_Id": 1963,
  "Playlist_Track_Id": 1951,
  "Track_Id": 5865
}
'

curl -X GET "localhost:8080/playlisttrack/1951"

curl -X DELETE "localhost:8080/playlisttrack/1951"

# --

curl -X GET "localhost:8080/track"

curl -X POST "localhost:8080/track" -H 'Content-Type: application/json' -d'
{
  "Album_Id": 3461,
  "Bytes": 5643,
  "Composer": "bar",
  "Genre_Id": 8199,
  "Media_Type_Id": 1069,
  "Milliseconds": 4353,
  "Name": "building",
  "Unit_Price": 272.28792
}
'

curl -X POST "localhost:8080/track/198" -H 'Content-Type: application/json' -d'
{
  "Album_Id": 3461,
  "Bytes": 5643,
  "Composer": "bar",
  "Genre_Id": 8199,
  "Media_Type_Id": 1069,
  "Milliseconds": 4353,
  "Name": "building",
  "Track_Id": 198,
  "Unit_Price": 272.28792
}
'

curl -X GET "localhost:8080/track/198"

curl -X DELETE "localhost:8080/track/198"

# --

