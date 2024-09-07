<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Donor</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <style>
    .container {
      width: 50%;
      margin: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: aquamarine;
    }

    header h1 {
      color: red;
      text-align: center;
    }

    .container div {
      margin-bottom: 15px;
    }

    .container label {
      margin-right: 10px;
    }

    .container input,
    .container select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .container input[type="radio"] {
      width: auto;
    }

    .container input[type="submit"] {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
      font-size: 16px;
    }

    .container input[type="submit"]:hover {
      background-color: #218838;
    }

    .btn {
      display: inline-block;
      font-weight: 400;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      user-select: none;
      border: 1px solid transparent;
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      line-height: 1.5;
      border-radius: 0.25rem;
      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
        border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      color: #fff;
      background-color: #007bff;
      border-color: #007bff;
      text-decoration: none;
    }

    .btn:hover {
      color: #fff;
      background-color: #0056b3;
      border-color: #004085;
      text-decoration: none;
    }
  </style>
  <script>
    function validateForm() {
      var name = document.getElementById("name").value;
      var phone = document.getElementById("phone").value;

      var dateOfBirth = document.getElementById("date_of_birth").value;

      var nameRegex = /^[a-zA-Z\s]+$/;
      var phoneRegex = /^\d{10}$/;

      // Validate Name
      if (!nameRegex.test(name)) {
        alert("Name must contain only letters and spaces.");
        return false;
      }

      // Validate Phone
      if (!phoneRegex.test(phone)) {
        alert("Phone number must be exactly 10 digits.");
        return false;
      }

      // Validate Age
      var dob = new Date(dateOfBirth);
      var today = new Date();
      var age = today.getFullYear() - dob.getFullYear();
      var month = today.getMonth() - dob.getMonth();

      if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
        age--;
      }

      if (age < 17) {
        alert("You must be at least 17 years old to register.");
        return false;
      }

      return true;
    }
  </script>
</head>
<style>
  body {
    background-color: lightslategray;

  }

  .h1 {
    background-color: brown;
    color: aquamarine;
  }
</style>

<body>
  <div class="container my-5">
    <header>
      <h1 style="background-color: brown; color:aquamarine">Add Donor</h1>
    </header>
    <br />
    <div>
      <form action="addconnect.php" method="POST" autocomplete="off">
        <div>
          <input
            type="text"
            name="name"
            id="name"
            required
            placeholder="Name" />
        </div>

        <div>
          <input type="email" name="email" id="email" placeholder="Email" />
        </div>
        <div>
          <input type="tel" name="phone" id="phone" placeholder="Contact" />
        </div>
        <div>
          <input
            type="text"
            name="address"
            id="address"
            required
            placeholder="Address" />
        </div>

        <div>
          <input
            type="date"
            name="date_of_birth"
            id="date_of_birth"
            required
            placeholder="Date of Birth" />
        </div>
        <div>
          Gender <br />
          <label for="male">Male</label>
          <input type="radio" name="gender" id="male" value="male" /> <br />
          <label for="female">Female</label>
          <input type="radio" name="gender" id="female" value="female" />
        </div>
        <div>
          <select name="type" required>
            <option value="">Select Blood Type</option>
            <option value="A">A</option>
            <option value="AB">AB</option>
            <option value="B">B</option>
            <option value="O">O</option>
          </select>
        </div>
        <select name="user_roles" id="user_roles">
          <option value="user">user</option>
          <option value="admin">admin</option>
        </select>
        <div>
          <input type="submit" value="Add Donor" />
        </div>
      </form>
    </div>
  </div>
</body>

</html>