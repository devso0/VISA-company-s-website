package helloworld;
import com.syncfusion.docio.*;

public class HelloWorld {

	public static void main(String[] args) throws Exception {

		// Creates a new instance of WordDocument (Empty Word Document)
		WordDocument document = new WordDocument();
		// Adds a section and a paragraph to the document
		document.ensureMinimal();
		// Appends text to the last paragraph of the document
		document.getLastParagraph().appendText("Hello World");
		// Saves the Word document
		document.save("Result.docx");
		// Closes the Word document
		document.close();

		System.out.println("Document generated successfully");

	}
}