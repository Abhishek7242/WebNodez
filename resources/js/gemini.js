import { GoogleGenerativeAI } from "@google/generative-ai";

const API_KEY = "AIzaSyD33XJDaflftv-k0Iz2KKqd9YlGZq45DeA"; // Replace with your real API key

const genAI = new GoogleGenerativeAI(API_KEY);

async function generateText(userPrompt) {
    console.log("Generating text with Gemini API...", userPrompt);
    const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

    const result = await model.generateContent(userPrompt);
    const responseText = await result.response.text();

    // Now ask Gemini to summarize the response in a 23-word title
    const titlePrompt = `
Generate a very short, clear, and engaging title (max 4 words) that summarizes the main idea. Use title case. No punctuation.

Content:
${userPrompt} your response :${responseText}
`;

    const titleResult = await model.generateContent(titlePrompt);
    const title = await titleResult.response.text();

    console.log("23-word Title:", title);

    return [responseText, title]; // Return the response text and title as an array
}

export { generateText }; 