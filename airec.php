<?php
// Include the config and header files
include('config.php');
include('header.php');

// Initialize a variable to hold occupation and course recommendations
$occupation = '';
$courses = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture occupation from form
    $occupation = htmlspecialchars(trim($_POST['occupation']));

    // Recommend courses based on occupation
    switch ($occupation) {
        case 'homemaker':
            $courses = [
                ['course' => 'Cyber Security Awareness', 'webpage' => ' https://www.cisa.gov/sites/default/files/2024-09/Secure-Our-World-Cybersecurity-Awareness-Month-Puzzles.pdf', 'youtube' => 'https://www.youtube.com/watch?v=H6t-Kd1l_Xo'],
                ['course' => ' Cyber Sceurity Management', 'webpage' => ' https://www.theforage.com/simulations/anz/cybersecurity-management-szf9', 'youtube' => 'https://youtu.be/-KL9APUjj3E?feature=shared'],
            ];
            break;
        case 'farmer':
            $courses = [
                ['course' => ' Cyber Shield', 'webpage' => 'https://www.udemy.com/course/organic-farming/', 'youtube' => ' https://youtu.be/PR5GD08DJmY?feature=shared'],
                ['course' => ' Cyber Security Awareness', 'webpage' => ' https://www.cisa.gov/sites/default/files/2024-09/Secure-Our-World-Cybersecurity-Awareness-Month-Puzzles.pdf', 'youtube' => ' https://youtu.be/KoFMd8Zq5yI?feature=shared'],
            ];
            break;
        case 'software professional':
            $courses = [
                ['course' => 'Job Simulation', 'webpage' => 'https://www.theforage.com/simulations/telstra/cybersecurity-cyyo', 'youtube' => ' https://youtu.be/SW6AE76Pi50?feature=shared'],
                ['course' => 'Cyber Security Management', 'webpage' => 'https://www.theforage.com/simulations/anz/cybersecurity-management-szf9', 'youtube' => ' https://youtu.be/VQthnaqrZg4?feature=shared'],
            ];
            break;
        case 'lecturer':
            $courses = [
                ['course' => 'Cyber Shield', 'webpage' => 'https://www.theforage.com/simulations/aig/cybersecurity-ku1i', 'youtube' => ' https://youtu.be/VQthnaqrZg4?feature=shared'],
                ['course' => 'Cyber Security Management', 'webpage' => 'https://www.theforage.com/simulations/anz/cybersecurity-management-szf9', 'youtube' => ' https://youtu.be/KoFMd8Zq5yI?feature=shared'],
            ];
            break;
        case 'businessman':
            $courses = [
                ['course' => 'Entrepreneurship Fundamentals', 'webpage' => 'https://www.theforage.com/simulations/aig/cybersecurity-ku1i', 'youtube' => ' https://youtu.be/-KL9APUjj3E?feature=shared'],
                ['course' => 'Cyber Shield', 'webpage' => 'https://www.coursera.org/learn/business-strategy', 'youtube' => ' https://youtu.be/PR5GD08DJmY?feature=shared'],
            ];
            break;
        default:
            $courses = [];
            break;
    }
}

?>

<div class="container">
    <h2>Course Recommendations Based on Occupation</h2>

    <form method="POST">
        <label for="occupation">Select Your Occupation:</label>
        <select name="occupation" id="occupation" required>
            <option value="">Select...</option>
            <option value="homemaker" <?= ($occupation === 'homemaker') ? 'selected' : ''; ?>>Homemaker</option>
            <option value="farmer" <?= ($occupation === 'farmer') ? 'selected' : ''; ?>>Farmer</option>
            <option value="software professional" <?= ($occupation === 'software professional') ? 'selected' : ''; ?>>Software Professional</option>
            <option value="lecturer" <?= ($occupation === 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
            <option value="businessman" <?= ($occupation === 'businessman') ? 'selected' : ''; ?>>Businessman</option>
        </select>
        <input type="submit" value="Get Recommendations">
    </form>

    <?php if ($occupation && !empty($courses)) : ?>
        <h3>Recommended Courses for a <?= ucfirst($occupation) ?>:</h3>
        <ul>
            <?php foreach ($courses as $course) : ?>
                <li>
                    <strong><?= $course['course'] ?></strong><br>
                    <a href="<?= $course['webpage'] ?>" target="_blank">Course Webpage</a> | 
                    <a href="<?= $course['youtube'] ?>" target="_blank">YouTube Video</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($occupation && empty($courses)) : ?>
        <p>No courses found for this occupation. Please select a valid occupation.</p>
    <?php endif; ?>
</div>

<?php
// Include footer
include('footer.php');
?>
