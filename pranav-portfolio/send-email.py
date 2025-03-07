import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import sys

# SMTP Configuration
SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 587
SMTP_USERNAME = "pranavkadamfilms@gmail.com"
SMTP_PASSWORD = "znks uqup rxno dwin"  # Use App Password, NOT your real password

def send_email(name, email, phone, message):
    try:
        # Email Setup
        msg = MIMEMultipart()
        msg["From"] = SMTP_USERNAME
        msg["To"] = "pranavkadamfilms@gmail.com"  # Change to your email
        msg["Subject"] = "New Contact Form Submission"

        body = f"""
        New Contact Form Submission:

        Name: {name}
        Email: {email}
        Phone: {phone}
        Message: {message}
        """

        msg.attach(MIMEText(body, "plain"))

        # Sending Email
        server = smtplib.SMTP(SMTP_SERVER, SMTP_PORT)
        server.starttls()
        server.login(SMTP_USERNAME, SMTP_PASSWORD)
        server.send_message(msg)
        server.quit()

        print("success")  # This will be captured in PHP

    except Exception as e:
        print(f"Error: {e}")  # Send error message to PHP

if __name__ == "__main__":
    if len(sys.argv) < 5:
        print("Error: Missing arguments")
        sys.exit(1)
    
    name = sys.argv[1]
    email = sys.argv[2]
    phone = sys.argv[3]
    message = sys.argv[4]
    
    send_email(name, email, phone, message)



