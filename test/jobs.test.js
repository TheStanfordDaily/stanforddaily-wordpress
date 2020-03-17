import fetch from "cross-fetch";

const ENDPOINT_URL = "http://localhost:8000";

const JOBS_ENDPOINT = `${ENDPOINT_URL}/wp-json/tsd/v1/jobs`;

describe("jobs rest api", () => {
    test("get jobs", async () => {
        const response = await fetch(`${JOBS_ENDPOINT}`).then(e => e.json());
        // expect(response).toMatchSnapshot();
    });
    test("get a job - not found", async () => {
        const response = await fetch(`${JOBS_ENDPOINT}/39393939`);
        expect(response.status).toEqual(404);
        expect(await response.text()).toContain("Job not found");
    });
    test("add a job - invalid", async () => {
        const data = {
            jobType: "Internship"
        };
        const response = await fetch(`${JOBS_ENDPOINT}`, {
            method: "POST",
            body: JSON.stringify(data)
        });
        expect(response.status).toEqual(400);
        expect(await response.text()).toContain("Invalid key");
    });
    test("add a job and view it", async () => {
        const data = {
            jobType: "Internship",
            jobTitle: "as",
            companyName: "test",
            companySite: "esolutions.com",
            companyLogo: "data:application/pdf;name=2020-02-24%20%E2%80%94%2",
            jobLocation: "atl, GA",
            jobDescription: "asdsad",
            appInstructions: "asdasdasd"
        };
        const response = await fetch(`${JOBS_ENDPOINT}`, {
            method: "POST",
            body: JSON.stringify(data)
        }).then(e => e.json());
        const { id } = response;
        expect(Number(id)).toBeGreaterThan(0);
        const getResponse = await fetch(`${JOBS_ENDPOINT}/${id}/`).then(e => e.json());
        expect(getResponse).toEqual({
            id,
            jobType: "Internship",
            jobTitle: "as",
            companyName: "test",
            companySite: "esolutions.com",
            // companyLogo: "data:application/pdf;name=2020-02-24%20%E2%80%94%2",
            jobLocation: "atl, GA",
            jobDescription: "asdsad",
            appInstructions: "asdasdasd",
            post_status: "draft"
        });
        const jobsResponse = await fetch(`${JOBS_ENDPOINT}`).then(e => e.json());
        expect(jobsResponse.length).toBeGreaterThan(0);
    });
});