import sys
import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.impute import SimpleImputer

# Load the dataset
data = pd.read_csv('Student HUB.csv')

# Drop columns with only NaN values
data.dropna(axis=1, how='all', inplace=True)

# Split the data into features (X) and target variable (y)
X = data.drop(['Progress'], axis=1)  # Features
y = data['Progress']  # Target variable

# Impute missing values with the mean of each column
imputer = SimpleImputer(strategy='mean')
X = imputer.fit_transform(X)

# Check if there are still NaN values
if pd.DataFrame(X).isnull().values.any():
    raise ValueError("Input contains NaN after imputation")

# Create a random forest classifier model
model = RandomForestClassifier(random_state=42)

# Train the model on the full dataset
model.fit(X, y)

if len(sys.argv) < 2:
    print("Please provide the total marks as a command-line argument.")
    sys.exit(1)

total_marks = float(sys.argv[1])

# Create a DataFrame with the input total marks
student_data = pd.DataFrame(columns=data.columns[:-2])  # Exclude 'Total' and 'Progress' columns
student_data.loc[0, 'Total'] = total_marks
student_data = imputer.transform(student_data)  # Impute missing values with the mean

# Make a prediction
predicted_progress = model.predict(student_data)

# Print the predicted progress
print(predicted_progress[0])

# Store the total marks and predicted progress in a CSV file
with open('prediction_history.csv', 'a') as f:
    f.write(f"{total_marks},{predicted_progress[0]}\n")
