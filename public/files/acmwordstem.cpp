#include<iostream>
#include<cstring>
using namespace std;
short t,n;
string w[15];
string lar;
string LCSubStr(string X, string Y, int m, int n)
{	int LCSuff[m+1][n+1];
    int result = 0;
    int last=n+1;
    for (int i=0; i<=m; i++)
    {
        for (int j=0; j<=n; j++)
        {
            if (i == 0 || j == 0)
                LCSuff[i][j] = 0;

            else if (X[i-1] == Y[j-1])
            {
                LCSuff[i][j] = LCSuff[i-1][j-1] + 1;
                //result = max(result, LCSuff[i][j]);
                if(result>LCSuff[i][j])
                {	//cout<<start<<"aa\n";
      			}
                else
                {	result=LCSuff[i][j];
                	last=j;
                	//cout<<start<<"bb\n";
                }
            }
            else LCSuff[i][j] = 0;
        }
    }
    string s="";
    int i=last-result;
    while(i<last)
    {	//s[k++]=Y[i];
    	s+=Y[i];
    	i++;
    }
    return s;
}
int main()
{	cin>>t;
	while(t-->0)
	{	cin>>n;
		for(int i=0;i<n;i++)
			cin>>w[i];
		/*for(int i=0;i<n;i++)
			cout<<w[i]<<"\n";*/
		lar=w[0];
		for(int i=1;i<n;i++)
			lar=LCSubStr(lar,w[i],lar.size(),w[i].size());
		/*if(lar.size()==1)
		{	for(int i=0;i<w)
		}
		else*/
			cout<<lar<<"\n";
	}
	return 0;
}
