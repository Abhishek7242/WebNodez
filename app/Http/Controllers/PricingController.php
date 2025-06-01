<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index($service) {
    $servicesArray = [
        "fixed-price" => [
            'description' => '  We build fast, responsive, and secure websites tailored to your business goals. Whether it’s a sleek landing page or a full-featured web application, our development team ensures high performance and scalability every step of the way.',
            'detailsArray' => [
[
'title' => 'Fixed Price Project Workflow',
'description' => 'This structured sequence outlines the ideal workflow for managing a fixed price project. It ensures clear communication, predictable costs, and smooth delivery by breaking the process into well-defined stages.'
],
[
'title' => 'Define Project Scope',
'description' => 'Clearly specify the goals, features, deliverables, and boundaries of the project. Ensure all parties have a shared understanding to avoid scope creep.'
],
[
'title' => 'Create Requirements Documentation',
'description' => 'Develop detailed functional and technical specifications. This acts as a blueprint and must be reviewed and approved by stakeholders before proceeding.'
],
[
'title' => 'Estimate Cost and Timeline',
'description' => 'Provide a fixed quote based on the scope and effort required. Include a timeline with buffers for testing, revisions, and handover.'
],
[
'title' => 'Draft Contract and Milestones',
'description' => 'Outline payment terms, project phases, and responsibilities in a written agreement. Include milestone-based payments and revision limits.'
],
[
'title' => 'Design Phase',
'description' => 'Start with wireframes and UI/UX design or technical architecture. Get client approval before development begins to avoid rework.'
],
[
'title' => 'Development Phase',
'description' => 'Implement features based on the approved designs and documentation. Ensure code quality and meet predefined milestones.'
],
[
'title' => 'Testing and Quality Assurance',
'description' => 'Thoroughly test the product for functionality, performance, and security. Fix all bugs and ensure it meets the agreed-upon criteria.'
],
[
'title' => 'Final Delivery and Approval',
'description' => 'Deliver the completed project or product. Ensure everything functions as expected. Obtain client sign-off to confirm project completion.'
],
[
'title' => 'Post-Launch Support (Optional)',
'description' => 'Offer a short-term support window for minor bug fixes or adjustments. Include terms in the original contract if provided.'
]
],

              
        

        ],
        "hourly-model" => [
            'description' => 'Innovative, user-focused online stores designed to showcase your brand’s uniqueness, engage customers, and drive sales. We combine beautiful design with seamless functionality to create shopping experiences that build loyalty and grow your business.',
            'detailsArray' => [
  [
    'title' => 'Initial Consultation & Requirement Gathering',
    'description' => 'Discuss project goals, priorities, and areas likely to evolve. Identify core deliverables and understand how flexibility will be managed.'
  ],
  [
    'title' => 'Set Up Hourly Rate & Tracking Tools',
    'description' => 'Agree on hourly rates, billing cycles, and choose a time tracking tool (e.g., Toggl, Harvest) to ensure transparent and accurate logging of work hours.'
  ],
  [
    'title' => 'Define Communication & Reporting Protocol',
    'description' => 'Establish regular check-ins and progress updates to keep everyone aligned. Set expectations for status reports and how change requests will be handled.'
  ],
  [
    'title' => 'Begin Agile Development or Work',
    'description' => 'Start work in small increments or sprints, delivering value continuously and adapting priorities as requirements evolve.'
  ],
  [
    'title' => 'Track Hours & Deliverables',
    'description' => 'Log all work hours diligently. Track completed tasks alongside hours spent to maintain clear accountability.'
  ],
  [
    'title' => 'Review & Adjust Priorities',
    'description' => 'Conduct regular reviews to assess progress and pivot as needed based on feedback and changing needs.'
  ],
  [
    'title' => 'Invoice & Payment',
    'description' => 'Generate invoices based on tracked hours at agreed intervals. Ensure payments are timely to maintain workflow continuity.'
  ],
  [
    'title' => 'Ongoing Support & Iteration',
    'description' => 'Continue iterative work and support as requested, with billing continuing hourly as per usage.'
  ]
  ],

        ],
        "dedicated-team" => [
            'description' => 'A comprehensive guide to hiring and managing a dedicated team or resource on a monthly basis. This model is ideal for projects requiring sustained growth, continuous support, and close collaboration with a specialized team.',
            'detailsArray' =>  [
  [
    'title' => 'Understand Business Needs & Team Requirements',
    'description' => 'Discuss long-term goals, technical needs, and team roles to determine the size and skill set of the dedicated team.'
  ],
  [
    'title' => 'Define Scope & Responsibilities',
    'description' => 'Clarify the team’s responsibilities, expected deliverables, working hours, communication channels, and performance metrics.'
  ],
  [
    'title' => 'Recruitment & Team Formation',
    'description' => 'Hire or allocate skilled professionals aligned with the project needs. Set up onboarding and introduce them to your company culture.'
  ],
  [
    'title' => 'Set Up Project Infrastructure & Tools',
    'description' => 'Provide access to required software, tools, and collaboration platforms. Establish workflows and communication protocols.'
  ],
  [
    'title' => 'Kickoff & Planning',
    'description' => 'Initiate the project with a detailed plan, sprint schedules, and clear milestones. Align team goals with business objectives.'
  ],
  [
    'title' => 'Execution & Continuous Delivery',
    'description' => 'The dedicated team works full-time on your project, iterating based on feedback and evolving requirements.'
  ],
  [
    'title' => 'Regular Reporting & Reviews',
    'description' => 'Conduct weekly or bi-weekly meetings to review progress, discuss blockers, and adjust priorities.'
  ],
  [
    'title' => 'Monthly Billing & Contract Management',
    'description' => 'Invoices are generated monthly based on the team size and agreed terms. Contracts can be adjusted as needs evolve.'
  ],
  [
    'title' => 'Ongoing Support & Scaling',
    'description' => 'Scale the team up or down based on business needs and continue support for long-term growth.'
  ]
  ],

        ],
       
        // Add more services here
    ];

    // Check if the requested service exists
    if (!array_key_exists($service, $servicesArray)) {
        abort(404); // Service not found
    }

    // Format the service name: replace dashes and ampersands, then capitalize
    $formattedService = str_replace(['-'], ' ', $service);
    $formattedService = str_replace(['&'], ' & ', $formattedService);
    $formattedService = ucwords($formattedService);
    $formattedService = str_replace([' - '], '-', $formattedService);

    // Fix UI/UX casing specifically after ucwords
    $formattedService = str_ireplace(['Ui/Ux', 'Ui-Ux', 'Ui Ux'], 'UI/UX', $formattedService);


    // Get the service details from the array
    $serviceDetails = $servicesArray[$service];

    // Pass both formatted name and details to the view
    return view('frontend.pricing', [
        'service' => $formattedService,
        'details' => $serviceDetails,
        'detailsArray'=> $serviceDetails['detailsArray'],
       
    ]);
}
}