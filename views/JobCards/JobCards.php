<?php
include("./classes/JobCard.php");
include("./queries/jobQueries.php");

$searchCookie = NULL;

if (isset($_COOKIE["regex"])) {
    $searchCookie = $_COOKIE["regex"];
}

//Function comes from jobQueries
$job_posts = getJobPostings();

$jobsArray = [];

foreach ($job_posts as $job_post) {
    if (!$searchCookie || $searchCookie === "") {
        $jobsArray["Job" . $job_post["id"]] = new JobCard(
            $job_post['id'],
            $job_post["company_name"],
            $job_post["company_position"],
            $job_post["company_website"],
            $job_post["date_applied"],
            $job_post["company_location"],
            $job_post["about_company"],
            $job_post["about_position"],
            $job_post["notes"]
        );
    } else if (
        strpos(strtoupper($job_post["company_name"]), strtoupper($searchCookie)) !== false
        && ucfirst($job_post["company_name"][0]) === ucfirst($searchCookie[0])
    ) {
        $jobsArray["Job" . $job_post["id"]] = new JobCard(
            $job_post['id'],
            $job_post["company_name"],
            $job_post["company_position"],
            $job_post["company_website"],
            $job_post["date_applied"],
            $job_post["company_location"],
            $job_post["about_company"],
            $job_post["about_position"],
            $job_post["notes"]
        );
    } else if (
        strpos(strtoupper($job_post["company_position"]), strtoupper($searchCookie)) !== false
        && ucfirst($job_post["company_position"][0]) === ucfirst($searchCookie[0])
    ) {
        $jobsArray["Job" . $job_post["id"]] = new JobCard(
            $job_post['id'],
            $job_post["company_name"],
            $job_post["company_position"],
            $job_post["company_website"],
            $job_post["date_applied"],
            $job_post["company_location"],
            $job_post["about_company"],
            $job_post["about_position"],
            $job_post["notes"]
        );
    } else { }
}
?>

<?php foreach ($jobsArray as $job) { ?>
    <div class="card" style="width: 90%; margin: 30px auto">
        <h5 class="card-header" style="cursor: pointer">
            <?php
                echo "{$job->getCompanyName()} - {$job->getCompanyPosition()}";
                ?>
            <div style="position: absolute; right: 18px; top: 12px;">
                <i class="fas fa-pencil-alt" style="margin-right: 10px;" onclick="updatingACard({
                id: '<?php echo $job->getId(); ?>',
                company_name: '<?php echo $job->getCompanyName(); ?>',
                company_position: '<?php echo $job->getCompanyPosition(); ?>',
                company_website: '<?php echo $job->getCompanyWebsite(); ?>',
                date_applied: '<?php echo $job->getAppliedDate(); ?>',
                company_location: '<?php echo $job->getLocation(); ?>',
                about_company: '<?php echo $job->getAboutCompany(); ?>',
                about_position: '<?php echo $job->getAboutPosition(); ?>',
                company_notes: '<?php echo $job->getNotes(); ?>',})">
                </i>
                <i class="fas fa-trash-alt" onclick="deletingACard('<?php echo $job->getId(); ?>')"></i>
            </div>
        </h5>

        <div class="card-body">
            <h5 class="card-title">Company Website</h5>
            <a href="#" class="card-link">
                <?php
                    echo $job->getCompanyWebsite();
                    ?>
            </a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Date Applied</h5>
            <p class="card-text">
                <?php
                    echo $job->getAppliedDate();
                    ?>
            </p>
        </div>
        <div class="card-body">
            <h5 class="card-title">Location</h5>
            <p class="card-text">
                <?php
                    echo $job->getLocation();
                    ?>
            </p>
        </div>
        <div class="card-body">
            <h5 class="card-title">About Company</h5>
            <p class="card-text">
                <?php
                    echo $job->getAboutCompany();
                    ?>
            </p>
        </div>
        <div class="card-body">
            <h5 class="card-title">About Position</h5>
            <p class="card-text">
                <?php
                    echo $job->getAboutPosition();
                    ?>
            </p>
        </div>
        <div class="card-body">
            <h5 class="card-title">Notes</h5>
            <p class="card-text">
                <?php
                    echo $job->getNotes();
                    ?>
            </p>
        </div>
    </div>
<?php } ?>