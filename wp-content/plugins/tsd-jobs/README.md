# tsd-jobs REST API

Endpoints:

## Get list of published jobs
GET https://www.stanforddaily.com/wp-json/tsd/v1/jobs

Gets all published jobs (only includes posts with post status "publish").

```js
[
    {
        id: 2,
        jobType: "Internship",
        jobTitle: "as",
        companyName: "test",
        companySite: "esolutions.com",
        jobLocation: "atl, GA",
        jobDescription: "asdsad",
        appInstructions: "asdasdasd"
    }
]
```


## Get job by ID
GET https://www.stanforddaily.com/wp-json/tsd/v1/jobs/2/

Get job by ID, even if it's a "draft" post.

response body:

```js
{
    id: 2,
    jobType: "Internship",
    jobTitle: "as",
    companyName: "test",
    companySite: "esolutions.com",
    jobLocation: "atl, GA",
    jobDescription: "asdsad",
    appInstructions: "asdasdasd",
    post_status: "draft"
}
```

## Add a job
POST https://www.stanforddaily.com/wp-json/tsd/v1/jobs

Creates a job with status "draft"; this endpoint is called upon submission of the jobs board "Submit Job" form.

request body:

```js
{
    jobType: "Internship",
    jobTitle: "as",
    companyName: "test",
    companySite: "esolutions.com",
    companyLogo: "data:application/pdf;name=2020-02-24%20%E2%80%94%2",
    jobLocation: "atl, GA",
    jobDescription: "asdsad",
    appInstructions: "asdasdasd"
}
```

response body:

```js
{
    id: 2
}
```